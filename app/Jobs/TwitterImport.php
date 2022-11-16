<?php

namespace App\Jobs;

use App\Models\Creator;
use App\Models\Import;
use App\Models\Notification;
use App\Models\User;
use App\Models\UserList;
use App\Traits\GeneralTrait;
use App\Traits\SocialScrapperTrait;
use Carbon\Carbon;
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

class TwitterImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SocialScrapperTrait, GeneralTrait, Batchable;

    public $name = 'twitter_import';

    public $tries = 3;

    private $username;

    private $tags;

    private $meta;

    private $listId;

    private $userId;

    private $platformUser;

    private $importId;

    private $teamId = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($username, $tags, $meta = null, $listId = null, $userId = null, $importId = null, $teamId = null)
    {
        $this->username = $username;
        $this->tags = $tags;
        $this->meta = $meta;
        $this->listId = $listId;
        $this->userId = $userId;
        $this->importId = $importId;
        if (is_null($teamId) && $listId) {
            $list = UserList::where('id', $listId)->first();
            if ($list) {
                $this->teamId = $list->team_id;
            }
        } elseif ($teamId) {
            $this->teamId = $teamId;
        }
        $this->platformUser = User::with('currentTeam')->where('id', $this->userId)->first();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            if ($this->userId && ! is_null($this->platformUser) && ! $this->platformUser->is_admin && $this->platformUser->currentTeam->credits <= 0) {
                Import::markImport($this->importId, ['twitter']);
                if ($this->batch() && ! $this->batch()->cancelled()) {
                    $this->batch()->cancel();
                    DB::table('job_batches')->where('id', $this->batch()->id)->update(['error_code' => Import::ERROR_OUT_OF_CREDITS]);
//                    $this->platformUser->sendNotification(('Importing batch '.$this->batch()->id.' failed'), Notification::BATCH_IMPORT_FAILED,
//                        DB::table('job_batches')->where('id', $this->batch()->id)->first());
                } elseif (! $this->batch()) {
//                    Import::sendSingleNotification($this->batch(), $this->platformUser, ('importing twitter user '.$this->username.' failed'), Notification::OUT_OF_CREDITS);
                }

                return;
            }

            if (($this->userId && is_null($this->platformUser)) || ($this->batch() && $this->batch()->cancelled())) {
                Import::markImport($this->importId, ['twitter']);
                if ($this->batch() && ! $this->batch()->cancelled()) {
                    $this->batch()->cancel();
//                    $this->platformUser->sendNotification(('Importing batch '.$this->batch()->id.' failed'), Notification::BATCH_IMPORT_FAILED,
//                        DB::table('job_batches')->where('id', $this->batch()->id)->first());
                }

                return;
            }

            $creators = Creator::query()->whereIn('twitter_handler', $this->username)->get();
            // 30 days diff
            foreach ($creators as $creator) {
                if ($creator && ! is_null($creator->twitter_last_scrapped_at) && (is_null($this->platformUser) || ! $this->platformUser->is_admin)) {
                    $lastScrappedDate = Carbon::parse($creator->twitter_last_scrapped_at);
                    if ($lastScrappedDate->diffInDays(Carbon::now()) < 30) {
                        Creator::addToListAndCrm($creator, $this->listId, $this->userId, $this->teamId);
                        Import::markImport($this->importId, ['twitter']);
//                    Import::sendSingleNotification($this->batch(), $this->platformUser, ('Imported twitter user '.$this->username), Notification::SINGLE_IMPORT);
                        return;
                    }
                }
            }

            if ($this->username) {
                $response = self::scrapTwitter($this->username);
                if ($response->getStatusCode() == 200) {
                    $response = json_decode($response->getBody()->getContents());
                    if (count($response->data)) {
                        foreach ($response->data as $data) {
                            $this->insertInDatabase($data);
                            Import::markImport($this->importId, ['twitter']);
//                        Import::sendSingleNotification($this->batch(), $this->platformUser, ('Imported twitter user '.$this->username), Notification::SINGLE_IMPORT);
                            Log::channel('slack')->info('imported user.', ['username' => $this->username, 'network' => 'twitter']);
                        }
                    } else {
                        Import::markImport($this->importId, ['twitter']);
                        $this->fail(new \Exception(('No profile data or no such profile for username '.$this->username), 200));
//                        Import::sendSingleNotification($this->batch(), $this->platformUser, ('No profile data or no such profile for twitter user '.$this->username), Notification::SINGLE_IMPORT_FAILED);
                        Log::channel('slack_warning')->info('No profile data or no such profile for username', ['id' => $this->id, 'username' => $this->username, 'network' => 'twitter']);
                    }
                } elseif ($response->getStatusCode() == 504) {
                    if ($this->attempts() < $this->tries) {
                        $this->release(10);
                    } else {
                        Import::markImport($this->importId, ['twitter']);
                        $this->fail(new \Exception(('Timed out for username '.$this->username), $response->getStatusCode()));
//                        Import::sendSingleNotification($this->batch(), $this->platformUser, ('Importing twitter user '.$this->username.' failed. Try again later.'), Notification::SINGLE_IMPORT_FAILED);
                        Log::channel('slack_warning')->info('Timed out.', ['id' => $this->id, 'username' => $this->username, 'network' => 'twitter']);
                    }
                } elseif ($response->getStatusCode() == 401) {
                    Import::saveTwitchToken($this->listId);
                    $this->release(5);
                } elseif ($response->getStatusCode() == 429) {
                    $this->release(5);
                    Cache::put('twitter_lock', 1, now()->addMinute());
                } else {
                    if ($this->attempts() < $this->tries) {
                        $this->release(10);
                    } else {
                        Import::markImport($this->importId, ['twitter']);
                        $this->fail(new \Exception($response->getBody()->getContents(), $response->getStatusCode()));
//                        Import::sendSingleNotification($this->batch(), $this->platformUser, ('Importing twitter user '.$this->username.' failed. Try again later.'), Notification::SINGLE_IMPORT_FAILED);
//                        Import::sendSingleNotification($this->batch(), $this->platformUser, ('Importing twitter user '.$this->username.' failed. Try again later.'), Notification::SINGLE_IMPORT_FAILED);
                        Log::channel('slack_warning')->info('error', ['response' => $response->getBody()->getContents(), 'username' => $this->username, 'network' => 'twitter']);
                    }
                }
            }
        } catch (\Exception $e) {
            if ($this->attempts() < $this->tries) {
                $this->release(10);
            } else {
                Import::markImport($this->importId, ['twitter']);
                if ($this->batch()) {
                    Log::channel('slack_warning')->info('internal error from with in batch '.$this->batch()->id, ['message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'network' => 'twitter']);
                } else {
//                    Import::sendSingleNotification($this->batch(), $this->platformUser, ('Importing twitter user '.$this->username.' failed. Try again later.'), Notification::SINGLE_IMPORT_FAILED);
                    Log::channel('slack_warning')->info('internal error, import cancelled.', ['id' => $this->id, 'username' => $this->username, 'message' => $e->getMessage(), 'line' => $e->getLine(), 'file' => $e->getFile(), 'network' => 'twitter']);
                }
                $this->fail($e);
            }
        }
    }

    public function insertInDatabase($data)
    {
        $creatorIds = [];
        foreach ($data as $user) {
            $creator = Creator::where('twitter_handler', $user->login)->orWhere('twitter_id', $user->id)->first() ?? new Creator();
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

            $creator->twitter_id = $user->id;
            $creator->twitter_handler = $user->login;
            $creator->twitter_name = $user->display_name;
            $creator->twitter_biography = $user->description;
            $creator->twitter_is_verified = $user->broadcaster_type == 'partner';

            $meta = [];
            $meta['broadcaster_type'] = $user->broadcaster_type;
            $meta['profile_pic_url'] = $user->profile_image_url;
            $meta['offline_pic_url'] = $user->offline_image_url;
            $meta['view_count'] = $user->view_count;
            $meta['created_at'] = $user->created_at;

            $creator->twitter_meta = $meta;
            $creator->type = 'CREATOR';

            $creator->tags = Creator::getTags($this->tags, $creator);
            $creator->emails = Creator::getEmails($user, $this->meta['emails'] ?? [], $creator->emails);

            $creator->first_name = ucfirst(strtolower($this->meta['firstName'] ?? $creator->first_name));
            $creator->last_name = ucfirst(strtolower($this->meta['lastName'] ?? $creator->last_name));
            $creator->city = $this->meta['city'] ?? $creator->city;
            $creator->country = $this->meta['country'] ?? $creator->country;
            $creator->wiki_id = $this->meta['wikiId'] ?? $creator->wiki_id;

            $gender = strtolower($this->meta['gender'] ?? null);
            if (! $creator->gender_updated && ! in_array($gender, ['male', 'female'])) {
                // in case not found hit gender api
                $genderResponse = self::getUserGender($user->display_name);
                $gender = $genderResponse->gender;
                $genderAccuracy = $genderResponse->accuracy;
                $creator->gender = $gender;
                $creator->gender_accuracy = $genderAccuracy;
            } elseif (in_array($gender, ['male', 'female'])) {
                $creator->gender = $gender;
                $creator->gender_accuracy = 100;
            }
            $creator->twitter_last_scrapped_at = Carbon::now()->toDateTimeString();
            $creator->twitter_summary_last_scrapped_at = Carbon::now()->toDateTimeString();
            $creator->save();
            Creator::addToListAndCrm($creator, $this->listId, $this->userId, $this->teamId);
            $summary = null;
            try {
                $response = self::scrapTwitchSummary($user->login);
                SendSlackNotification::dispatch($response->getBody()->getContents());
                if ($response->getStatusCode() == 200) {
                    $summary = json_decode($response->getBody()->getContents());
                }
            } catch (\Exception $e) {
                SendSlackNotification::dispatch($e->getMessage());
            }
            if (! is_null($summary) && count((array) $summary)) {
                try {
                    $creator->twitter_average_viewers = $summary->avg_viewers;
                    $creator->twitter_followers = $summary->followers_total;
                    $meta = $creator->meta;
                    $meta['followers'] = $summary->followers;
                    $meta['rank'] = $summary->rank;
                    $meta['minutes_streamed'] = $summary->minutes_streamed;
                    $meta['max_viewers'] = $summary->max_viewers;
                    $meta['hours_watched'] = $summary->hours_watched;
                    $meta['views'] = $summary->views;
                    $meta['views_total'] = $summary->views_total;
                    $creator->twitter_meta = $meta;
                    $creator->twitter_engagement_rate = round($summary->avg_viewers / $summary->followers_total, 2);
                    $creator->save();
                } catch (\Exception $e) {
                    Log::info($user->login);
                    Log::info($e->getMessage());
                }
            }
            $creatorIds[] = $creator->id;
        }

        return $creatorIds;
    }
}
