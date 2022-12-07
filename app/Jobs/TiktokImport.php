<?php

namespace App\Jobs;

use App\Models\Creator;
use App\Models\Crm;
use App\Models\Import;
use App\Models\User;
use App\Models\UserList;
use App\Notifications\ImportNotification;
use App\Traits\GeneralTrait;
use App\Traits\SocialScrapperTrait;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\RateLimited;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class TiktokImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SocialScrapperTrait, GeneralTrait, Batchable;

    public $name = 'tiktok_import';

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
    public function __construct(
        $username,
        $tags = [],
        $meta = null,
        $listId = null,
        $userId = null,
        $importId = null,
        $teamId = null
    ) {
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
     * Get the middleware the job should pass through.
     *
     * @return array
     */
//    public function middleware() {
//        return [new RateLimited('tiktokImport')];
//    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (($this->userId && !is_null($this->platformUser)) && $this->platformUser->currentTeam->credits <= 0) {
            if ($this->batch()) {
                $this->batch()->cancel();
                DB::table('job_batches')->where('id', $this->batch()->id)->update(
                    ['error_code' => Import::ERROR_OUT_OF_CREDITS]
                );
            }

            return;
        }

        if (($this->userId && is_null($this->platformUser)) || ($this->batch() && $this->batch()->cancelled())) {
            Import::markImport($this->importId, ['tiktok']);
            if ($this->batch() && !$this->batch()->cancelled()) {
                $this->batch()->cancel();
            }

            return;
        }

        $creator = Creator::where('tiktok_handler', $this->username)->first();
        // 30 days diff
        if ($creator && !is_null($creator->tiktok_last_scrapped_at) && (is_null(
                    $this->platformUser
                ) || !$this->platformUser->is_admin)) {
            $lastScrappedDate = Carbon::parse($creator->tiktok_last_scrapped_at);
            if ($lastScrappedDate->diffInDays(Carbon::now()) < 30) {
                Creator::addToListAndCrm($creator, $this->listId, $this->userId, $this->teamId);
                Import::markImport($this->importId, ['tiktok']);

                return;
            }
        }

        try {
            $response = self::scrapTiktok($this->username);
            if (isset($response->username)) {
                $creator = $this->insertIntoDatabase($response);
                Import::markImport($this->importId, ['tiktok']);
                Log::channel('slack')->info('imported user.', ['username' => $this->username, 'network' => 'tiktok']);
            } else {
                Log::channel('slack_warning')->info(
                    ('NOOOO RESSPONSEE ' . $this->batch()->id),
                    [
                        'username' => $this->username,
                        'message' => json_encode($response),
                        'network' => 'tiktok'
                    ]
                );
            }
        } catch (\Exception $e) {
            if ($this->attempts() < $this->tries) {
                $this->release(10);
            } else {
                Import::markImport($this->importId, ['tiktok']);
                if ($this->batch()) {
                    Log::channel('slack_warning')->info(
                        ('internal error from with in batch ' . $this->batch()->id),
                        [
                            'username' => $this->username,
                            'message' => $e->getMessage(),
                            'line' => $e->getLine(),
                            'file' => $e->getFile(),
                            'network' => 'tiktok'
                        ]
                    );
                } else {
                    Log::channel('slack_warning')->info(
                        'internal error',
                        [
                            'username' => $this->username,
                            'message' => $e->getMessage(),
                            'line' => $e->getLine(),
                            'file' => $e->getFile(),
                            'network' => 'tiktok'
                        ]
                    );
                }
                $this->fail($e);
            }
        }
    }

    private function insertIntoDatabase($user)
    {
        $creator = Creator::where('tiktok_handler', $user->username)->first() ?? new Creator();
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
        $creator->first_name = ucfirst(strtolower($this->meta['firstName'] ?? $creator->first_name));
        $creator->last_name = ucfirst(strtolower($this->meta['lastName'] ?? $creator->last_name));
        $creator->city = $this->meta['city'] ?? $creator->city;
        $creator->country = $this->meta['country'] ?? $creator->country;
        $creator->wiki_id = $this->meta['wikiId'] ?? $creator->wiki_id;
        $creator->full_name = $user->name;
        $creator->tags = Creator::getTags($this->tags, $creator);

        $gender = strtolower($this->meta['gender'] ?? null);
        if (! $creator->gender_updated && ! in_array($gender, ['male', 'female'])) {
            // in case not found hit gender api
            $genderResponse = self::getUserGender($user->name);
            $gender = $genderResponse->gender;
            $genderAccuracy = $genderResponse->accuracy;
            $creator->gender = $gender;
            $creator->gender_accuracy = $genderAccuracy;
        } elseif (in_array($gender, ['male', 'female'])) {
            $creator->gender = $gender;
            $creator->gender_accuracy = 100;
        }

        $creator->tiktok_media = $this->getTimelineMedia($user->timeline_media, $creator);
        $creator->emails = Creator::getEmails($user, $this->meta['emails'] ?? [], $creator->emails);
        $creator->tiktok_handler = $user->username;

        $creator->tiktok_followers = $user->followers;
        $creator->tiktok_biography = $user->biography;
        $creator->tiktok_engagement_rate = round(floatval($user->likes/$user->followers), 2);

        // meta
        $meta = [];
        $meta['profile_pic_url'] = $this->getProfilePicUrl($user->profile_image_url, $creator);
        $meta['following_count'] = $user->following;
        $meta['likes'] = $user->likes;
        $meta['engaged_follows'] = round(floatval(($user->likes/$user->followers) * $user->followers), 2);
        $averageLikesAndComments = $this->getAverageLikesAndComments($user->timeline_media);
        $meta['average_likes'] = $averageLikesAndComments['average_likes'];
        $meta['average_comments'] = $averageLikesAndComments['average_comments'];
        $creator->tiktok_meta = ($meta);
        $creator->tiktok_last_scrapped_at = Carbon::now()->toDateTimeString();
        $creator->save();
        Creator::addToListAndCrm($creator, $this->listId, $this->userId, $this->teamId);
        return $creator;
    }

    public function getTimelineMedia($medias, $creator)
    {
        foreach ($creator->tiktok_media as $media) {
            try {
                $filename = explode(Creator::CREATORS_MEDIA_PATH, $media->display_url)[1];
                $path = Creator::CREATORS_MEDIA_PATH.$filename;
                Storage::disk('s3')->delete($path);
            } catch (\Exception $e) {
            }
        }
        $timelineMedia = collect();
        foreach ($medias as $media) {
            $display_url = self::uploadFile($media['thumbnail'], Creator::CREATORS_MEDIA_PATH);
            $timelineMedia->push([
                'display_url' => $display_url,
                'likes' => $media['likes'],
                'comments' => $media['comments'],
                'shares' => $media['shares'],
                'caption' => $media['caption'],
                'datetime' => $media['post_date']
            ]);
        }

        return $timelineMedia->toArray();
    }

    public function getProfilePicUrl($profilePicUrl, $creator)
    {
        try {
            $filename = explode(Creator::CREATORS_PROFILE_PATH, $creator->tiktok_meta->profile_pic_url)[1];
            $path = Creator::CREATORS_MEDIA_PATH.$filename;
            Storage::disk('s3')->delete($path);
        } catch (\Exception $e) {
        }
        if (is_null($profilePicUrl)) {
            return asset('images/thumnailLogo.5243720b.png');
        }
        return self::uploadFile($profilePicUrl, Creator::CREATORS_PROFILE_PATH);
    }

    public function getAverageLikesAndComments($timelineMedia)
    {
        $totalLikes = 0;
        $totalComments = 0;
        foreach ($timelineMedia as $media) {
            $totalLikes += $media['likes'];
            $totalComments += $media['comments'];
        }
        $mediaCount = count($timelineMedia);
        return [
            'average_likes' => round($mediaCount > 0 ? $totalLikes / $mediaCount : 0, 2),
            'average_comments' => round($mediaCount > 0 ? $totalComments / $mediaCount : 0, 2),
        ];
    }
}
