<?php

namespace App\Jobs;

use App\Models\Creator;
use App\Models\Import;
use App\Models\User;
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
use Illuminate\Support\Facades\Log;

class TwitchImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, SocialScrapperTrait, GeneralTrait, Batchable;

    public $name = 'twitch_import';
    public $tries = 3;

    private $id;
    private $username;
    private $tags;
    private $meta;
    private $listId;
    private $userId;
    private $platformUser;
    private $importId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($id, $username, $tags, $meta = null, $listId = null, $userId = null, $importId = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->tags = $tags;
        $this->meta = $meta;
        $this->listId = $listId;
        $this->userId = $userId;
        $this->importId = $importId;
        $this->platformUser = User::where('id', $this->userId)->first();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $creator = null;
        if ($this->id) {
            $creator = Creator::where('twitch_id', $this->id)->first();
        }
        if (is_null($creator) && $this->username) {
            $creator = Creator::where('twitch_handler', $this->username)->first();
        }
        // 30 days diff
        if ($creator && !is_null($creator->twitch_last_scrapped_at)) {
            $lastScrappedDate = Carbon::parse($creator->twitch_last_scrapped_at);
            if ($lastScrappedDate->diffInDays(Carbon::now()) < 30) {
                return;
            }
        }
        if (is_null($this->platformUser) || ($this->batch() && $this->batch()->cancelled())) {
            return;
        }

        if ($this->id || $this->username) {
            $token = Cache::get('twitch_token_'.$this->listId);
            if (empty($token)) {
                $token = Import::saveSwitchToken($this->listId);
            }
            $response = self::scrapTwitch($this->id, $token);
            if ($response->getStatusCode() == 200) {
                $response = json_decode($response->getBody()->getContents());
                if (count($response->data)) {
                    $this->insertInDatabase($response->data);
                }
            } elseif ($response->getStatusCode() == 401) {
                Import::saveSwitchToken($this->listId);
                $this->release(5);
            } elseif ($response->getStatusCode() == 429) {
                Cache::put('twitch_lock',  1, now()->addMinute());
            }
        }
    }

    public function insertInDatabase($data)
    {
        $creatorIds = [];
        foreach ($data as $user) {
            $creator['twitch_id'] = $user->id;
            $creator['twitch_handler'] = $user->login;
            $creator['twitch_name'] = $user->display_name;
            $creator['twitch_biography'] = $user->description;

            $meta = [];
            $meta['broadcaster_type'] = $user->broadcaster_type;
            $meta['profile_image_url'] = $user->profile_image_url;
            $meta['offline_image_url'] = $user->offline_image_url;
            $meta['view_count'] = $user->view_count;
            $meta['created_at'] = $user->created_at;
            $creator['twitch_meta'] = $meta;

            $existing = Creator::where('twitch_handler', $user->login)->orWhere('twitch_id', $user->id)->first();
            if ($existing) {
                $creator['tags'] = Creator::getTags($this->tags, $creator);
                $creator['emails'] = Creator::getEmails($user, $this->meta['emails'], $existing->emails);
                $existing->update($creator);
                $creatorIds[] = $existing->id;
            } else {
                $creator['emails'] = Creator::getEmails($user, $this->meta['emails'] ?? []);
                $creatorIds[] = Creator::create($creator)->id;
            }
        }
        return $creatorIds;
    }
}
