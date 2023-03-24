<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Models\Import;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;

class ImportAndAddTOCrm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    protected $handle;
    protected $network;
    private $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($handle, $network, $params)
    {
        $this->handle = $handle;
        $this->network = $network;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $creators = null;
        if ($this->network == 'instagram') {
            $creators = (new InstagramImport($this->handle, $this->params['tags'] ?? null, true, null, $this->params['meta'] ?? null))->handle();
        } elseif ($this->network == 'twitter') {
            $creators = (new TwitterImport($this->handle, $this->params['tags'] ?? null, $this->params['meta'] ?? null))->handle();
        } elseif ($this->network == 'tiktok') {
            $creators = (new TiktokImport($this->handle, $this->params['tags'] ?? null, $this->params['meta'] ?? null))->handle();
        } elseif ($this->network == 'twitch') {
            $creators = (new TwitchImport(null, $this->handle, $this->params['tags'] ?? null, $this->params['meta'] ?? null))->handle();
        }
        if (isset($creators)) {
            if (!is_array($creators)) {
                $creators = [$creators];
            }
            foreach ($creators as $creator) {
                $contactIds = Contact::saveContactFromSocial(
                    $creator,
                    $this->params['list_id'] ?? null,
                    $this->params['user_id'] ?? null,
                    $this->params['team_id'] ?? null,
                    $this->params['source'] ?? null,
                    $this->params['charge'] ?? null,
                    $this->params['override'] ?? null,
                    $this->params['contact_id'] ?? null
                );
                if (isset($this->params['creator_id'])) {
                    return;
                }
                foreach ($contactIds as $id) {
                    $this->params['contact_id'] = $id;
                    $this->params['charge'] = false;
                    $this->params['creator_id'] = $id;
                    $import = new Import();
                    if ($this->network != 'instagram' && strpos($creator->instagram_handler, 'instagram.com/') !== false && $import->instagram = $creator->instagram_handler) {
                        ImportAndAddTOCrm::dispatch($import->instagram, 'instagram', $this->params)->delay(now()->addSeconds(15));
                    } elseif ($this->network != 'twitch' && strpos($creator->twitch_handler, 'twitch.tv/') !== false && $import->twitch = $creator->twitch_handler) {
                        ImportAndAddTOCrm::dispatch($import->twitch, 'twitch', $this->params)->delay(now()->addSeconds(15));
                    } elseif ($this->network != 'tiktok' && strpos($creator->tiktok_handler, 'tiktok.com/') !== false && $import->tiktok = $creator->tiktok_handler) {
                        ImportAndAddTOCrm::dispatch($import->tiktok, 'tiktok', $this->params)->delay(now()->addSeconds(15));
                    } elseif ($this->network != 'twitter' && strpos($creator->twitter_handler, 'twitter.com/') !== false && $import->twitter = $creator->twitter_handler) {
                        ImportAndAddTOCrm::dispatch($import->twitter, 'twitter', $this->params)->delay(now()->addSeconds(15));
                    }
                }
            }
        }
    }
}
