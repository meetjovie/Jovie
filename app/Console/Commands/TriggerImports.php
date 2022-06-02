<?php

namespace App\Console\Commands;

use App\Jobs\InstagramImport;
use App\Jobs\SendSlackNotification;
use App\Jobs\TwitchImport;
use App\Models\Import;
use App\Models\User;
use App\Models\UserList;
use App\Traits\SocialScrapperTrait;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TriggerImports extends Command
{
    use SocialScrapperTrait;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trigger:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // get first 100 importrs for each user in pipeline
        // if which networks it has
        // dispath batch in bus for each available network

        $users = User::whereHas('pendingImports')->with('pendingImports')->get();
        foreach ($users as $user) {
            foreach ($user->pendingImports as $import) {

                $commonData = $this->setCommonDateForImport($import);

                if ($import->instagram && $import->instagram_scrapped != 1) {
                    // trigger instagram import
                    $instagramBatch = $import->getImportBatch('instagram');
                    if (! $instagramBatch->cancelled()) {
                        $this->triggerInstagramImport($import, $instagramBatch, $commonData);
                    }
                }
//                do this for each network
                if (($import->twitch || $import->twitch_id) && $import->twitch_scrapped != 1) {
                    // trigger instagram import
                    $twitchBatch = $import->getImportBatch('twitch');
                    if (! $twitchBatch->cancelled()) {
                        if (!Cache::has('twitch_token_'.$twitchBatch->user_list_id)) {
                            Import::saveSwitchToken($twitchBatch->user_list_id);
                        }
                        $this->triggerTwitchImport($import, $twitchBatch, $commonData);
                    }
                }
            }
        }
    }

    public function triggerTwitchImport($import, $batch, $commonData)
    {
        $batch->add([
            (new TwitchImport($import->twitch_id, $import->twitch, $commonData['tags'], $commonData['meta'], $import->user_list_id, $import->user_id, $import->id))->delay(now()->addSeconds(2))
        ]);
    }

    public function setCommonDateForImport($import)
    {
        $meta = [
            'gender' => $import->gender,
            'emails' => $import->emails,
            'firstName' => $import->first_name,
            'lastName' => $import->last_name,
            'city' => $import->city,
            'country' => $import->country,
            'wikiId' => $import->wikiId,
            'socialHandlers' => $import->social_handlers
        ];
        $tags = null;
        if ($import->tags && json_decode($import->tags)) {
            $tags = implode(',', json_decode($import->tags));
        }

        return [
            'meta' => $meta,
            'tags' => $tags
        ];
    }

    public function triggerInstagramImport($import, $batch, $commonData)
    {
        $instagram = $import->instagram;
        if (!empty($instagram) && $instagram[0] == '@') {
            $instagram = substr($instagram, 1);
        }
        $batch->add([
            (new InstagramImport($instagram, $commonData['tags'], true, null, $commonData['meta'], $import->user_list_id, $import->user_id, $import->id))->delay(now()->addSeconds(1))
        ]);
    }
}
