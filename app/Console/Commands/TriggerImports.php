<?php

namespace App\Console\Commands;

use App\Jobs\InstagramImport;
use App\Jobs\SendSlackNotification;
use App\Models\Import;
use App\Models\User;
use App\Models\UserList;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class TriggerImports extends Command
{
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
        // dispath job in bus for each available network

        $users = User::whereHas('pendingImports')->with('pendingImports')->get();
        foreach ($users as $user) {
            foreach ($user->pendingImports as $import) {
                $batch = $import->getBatch();
                if ($import->instagram && $import->instagram_scrapped != 1) {
                    // trigger instagram import
                    $this->triggerInstagramImport($import, $batch);
                }
            }
        }
    }

    public function triggerInstagramImport($import, $batch)
    {
        $socialHandlers = [
            'twitch_handler' => $import->twitch,
            'twitch_id' => $import->twitch_id,
            'onlyFans_handler' => $import->onlyFans,
            'snapchat_handler' => $import->snapchat,
            'linkedin_handler' => $import->linkedin,
            'youtube_handler' => $import->youtube,
            'twitter_handler' => $import->twitter,
            'tiktok_handler' => $import->tiktok,
            'instagram_handler' => $import->instagram,
        ];
        $meta = [
            'emails' => $import->emails,
            'firstName' => $import->first_name,
            'lastName' => $import->last_name,
            'city' => $import->city,
            'country' => $import->country,
            'wikiId' => $import->wikiId,
            'socialHandlers' => $socialHandlers
        ];
        $tags = null;
        if ($import->tags && json_decode($import->tags)) {
            $tags = implode(',', json_decode($import->tags));
        }
        $batch->add([
            (new InstagramImport($import->instagram, $tags, true, null, $meta, $import->user_list_id, $import->user_id, $import->id))->delay(now()->addSeconds(1))
        ]);
    }
}
