<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Models\Creator;
use App\Models\Import;
use App\Models\Notification;
use App\Models\Team;
use App\Models\User;
use App\Models\UserList;
use App\Traits\GeneralTrait;
use App\Traits\SocialScrapperTrait;
use Carbon\Carbon;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class TwitterImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SocialScrapperTrait, GeneralTrait, Batchable;

    public $name = 'twitter_import';

    public $tries = 3;

    private $username;

    private $tags;

    private $meta;

    private $creatorsToReturn = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array|string $username, $tags, $meta = null)
    {
        if (!is_array($username)) {
            $username = [$username];
        }
        $this->username = $username;
        $this->tags = $tags;
        $this->meta = $meta;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $creators = Creator::query()->whereIn('twitter_handler', $this->username)->get();
            // 30 days diff
            foreach ($creators as $creator) {
                if ($creator && ! is_null($creator->twitter_last_scrapped_at)) {
                    $lastScrappedDate = Carbon::parse($creator->twitter_last_scrapped_at);
                    if ($lastScrappedDate->diffInDays(Carbon::now()) < 30) {
                        $key = array_search($creator->getRawOriginal('twitter_handler'), $this->username);
                        if ($key !== false) {
                            unset($this->username[$key]);
                        }
                        $this->triggerOtherNetworks($creator);
                        $this->creatorsToReturn[] = $creator;
                    }
                }
            }

            if ($this->username && !empty($this->username)) {
                $response = self::scrapTwitter($this->username);
                if ($response->getStatusCode() == 200) {
                    $response = json_decode($response->getBody()->getContents());
                    if (count($response->data)) {
                        foreach ($response->data as $data) {
                            Log::channel('slack')->info('imported user.', ['username' => $this->username, 'network' => 'twitter']);
                            $this->creatorsToReturn[] = $this->insertInDatabase($data);
                        }
                        return $this->creatorsToReturn;
                    } elseif (count($response->errors)) {
                        Log::channel('slack_warning')->info('No profile data or no such profile for username', ['username' => $this->username, 'network' => 'twitter']);
                        $this->fail(new \Exception(('No profile data or no such profile for username '.implode(', ', $this->username)), 200));
                    }
                } elseif ($response->getStatusCode() == 504) {
                    if ($this->attempts() < $this->tries) {
                        $this->release(10);
                    } else {
                        Log::channel('slack_warning')->info('Timed out.', ['id' => $this->id, 'username' => $this->username, 'network' => 'twitter']);
                        $this->fail(new \Exception(('Timed out for username '.implode(', ', $this->username)), $response->getStatusCode()));
                    }
                } elseif ($response->getStatusCode() == 429) {
                    $this->release(5);
                    Cache::put('twitter_lock', 1, now()->addMinute());
                } else {
                    if ($this->attempts() < $this->tries) {
                        $this->release(10);
                    } else {
                        Log::channel('slack_warning')->info('error', ['response' => $response->getBody()->getContents(), 'username' => $this->username, 'network' => 'twitter']);
                        $this->fail(new \Exception($response->getBody()->getContents(), $response->getStatusCode()));
                    }
                }
            } else {
                return $this->creatorsToReturn;
            }
        } catch (\Exception $e) {
            if ($this->attempts() < $this->tries) {
                $this->release(10);
            } else {
                if ($this->batch()) {
                    Log::channel('slack_warning')->info('internal error from with in batch '.$this->batch()->id, ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'network' => 'twitter']);
                } else {
                    Log::channel('slack_warning')->info('internal error, import cancelled.', ['username' => $this->username, 'message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'network' => 'twitter']);
                }
                $this->fail($e);
            }
        }
    }

    public function insertInDatabase($data)
    {
        $creator = Creator::where('twitter_handler', $data->username)->first() ?? new Creator();
        $creator->setAppends([]);
        if (isset($this->meta['socialHandlers'])) {
            foreach ($this->meta['socialHandlers'] as $k => $handler) {
                if ($k == 'youtube_handler' && $this->platformUser && $this->platformUser->is_admin && $handler) {
                    $creator->{$k} = $handler;
                } elseif ($k == 'youtube_handler' && $this->platformUser && $this->platformUser->is_admin && ! $handler) {
                    // donot do any thing
                    // donot do any thing
                } elseif ($handler) {
                    $creator->{$k} = $this->platformUser && $this->platformUser->is_admin ? ($handler ?? $creator->{$k}) : $creator->{$k};
                }
            }
        }

        $creator->twitter_handler = $data->username;
        $creator->twitter_name = $data->name;
        $creator->twitter_biography = $data->description;
        $creator->twitter_is_verified = $data->verified;

        $meta = [];
        $meta['profile_pic_url'] = $this->getProfilePicUrl($data->profile_image_url, $creator);
        $meta['tweet_count'] = $data->public_metrics->tweet_count;
        $meta['followers'] = $data->public_metrics->followers_count;
        $meta['following_count'] = $data->public_metrics->following_count;
        $meta['listed_count'] = $data->public_metrics->listed_count;
        $meta['created_at'] = $data->created_at;
        $meta['protected'] = $data->protected;
        $meta['id'] = $data->id;
        $creator->twitter_meta = $meta;

        $creator->twitter_followers = $data->public_metrics->followers_count;
//            $creator->twitter_engagement_rate = round($summary->avg_viewers / $summary->followers_total, 2);

        $creator->type = 'CREATOR';

        $creator->tags = Creator::getTags($this->tags, $creator);
        $creator->emails = Creator::getEmails($data, $this->meta['emails'] ?? [], $creator->emails);

        $creator->first_name = $this->remove_emoji(ucfirst(strtolower(($this->meta['firstName'] ?? null) ?: $creator->first_name))) ?: null;
        $creator->last_name = $this->remove_emoji(ucfirst(strtolower(($this->meta['lastName'] ?? null) ?: $creator->last_name))) ?: null;
        $creator->location = isset($data->location) ? $data->location : null;
        $creator->city = $this->meta['city'] ?? $creator->city;
        $creator->country = $this->meta['country'] ?? $creator->country;

        $gender = strtolower($this->meta['gender'] ?? null);
        if (! $creator->gender_updated && ! in_array($gender, ['male', 'female'])) {
            // in case not found hit gender api
            $genderResponse = self::getUserGender($data->name);
            $gender = $genderResponse->gender;
            $genderAccuracy = $genderResponse->accuracy;
            $creator->gender = $gender;
            $creator->gender_accuracy = $genderAccuracy;
        } elseif (in_array($gender, ['male', 'female'])) {
            $creator->gender = $gender;
            $creator->gender_accuracy = 100;
        }
        $creator->twitter_last_scrapped_at = Carbon::now()->toDateTimeString();

        if (isset($data->entities->url)) {
            $urls = $data->entities->url->urls;
            $import = new Import();
            foreach ($urls as $url) {
                if (strpos($url->expanded_url, 'instagram.com/') !== false && $import->instagram = $url->expanded_url) {
                    $creator->instagram_handler = $import->instagram;
                } elseif (strpos($url->expanded_url, 'twitch.tv/') !== false && $import->twitch = $url->expanded_url) {
                    $creator->twitch_handler = $import->twitch;
                } elseif (strpos($url->expanded_url, 'linkedin.com/') !== false && $import->linkedin = $url->expanded_url) {
                    $creator->linkedin_handler = $import->linkedin;
                } elseif (strpos($url->expanded_url, 'snapchat.com/') !== false && $import->snapchat = $url->expanded_url) {
                    $creator->snapchat_handler = $import->snapchat;
                } elseif (strpos($url->expanded_url, 'tiktok.com/') !== false && $import->tiktok = $url->expanded_url) {
                    $creator->tiktok_handler = $import->tiktok;
                } elseif (strpos($url->expanded_url, 'youtube.com/') !== false && $import->youtube = $url->expanded_url) {
                    $creator->youtube_handler = $import->youtube->channel_name ?? $import->youtube->channel_id;
                }
            }
        }

        $creator->save();
        $this->triggerOtherNetworks($creator);

        return $creator;
    }

    public function triggerOtherNetworks($creator)
    {
        $import = new Import();
        if (strpos($creator->instagram_handler, 'instagram.com/') !== false && $import->instagram = $creator->instagram_handler) {
            InstagramImport::dispatch($import->instagram, null, true, null, null)->onQueue(config('import.instagram_queue'))->delay(now()->addSeconds(15));
        } elseif (strpos($creator->twitch_handler, 'twitch.tv/') !== false && $import->twitch = $creator->twitch_handler) {
            TwitchImport::dispatch(null, $import->twitch, null, null)->onQueue(config('import.twitch_queue'))->delay(now()->addSeconds(15));
        } elseif (strpos($creator->tiktok_handler, 'tiktok.com/') !== false && $import->tiktok = $creator->tiktok_handler) {
            TiktokImport::dispatch($import->tiktok, null, null)->onQueue(config('import.twitch_queue'))->delay(now()->addSeconds(15));
        }
    }

    public function getProfilePicUrl($profilePicUrl, $creator)
    {
        try {
            $filename = explode(Creator::CREATORS_PROFILE_PATH, $creator->twitter_meta->profile_pic_url)[1];
            $path = Creator::CREATORS_MEDIA_PATH.$filename;
            Storage::disk('s3')->delete($path);
        } catch (\Exception $e) {
        }
        $file = str_replace('_normal.', '_reasonably_small.', $profilePicUrl);
        if (is_null($file)) {
            return asset('images/thumnailLogo.5243720b.png');
        }
        return self::uploadFile($file, Creator::CREATORS_PROFILE_PATH);
    }

    public function failed(Exception $exception)
    {
        return $this->creatorsToReturn;
    }
}
