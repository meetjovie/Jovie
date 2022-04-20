<?php

namespace App\Console\Commands;

use App\Jobs\InstagramImport;
use App\Jobs\SendSlackNotification;
use App\Models\Import;
use App\Models\UserList;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;

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
        $imports = Import::query()->limit(100)->get();

        foreach ($imports as $import) {
            $socialHandlers = [
                'twitch_handler' => $import->twitch,
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
            if ($import->instagram) {
                Bus::chain([
                    new InstagramImport($import->instagram, $tags, true, null, $meta, $import->user_list_id, $this->userId),
                    new SendSlackNotification('imported instagram user '.$import->instagram)
                ])->dispatch();
            }

        }
    }
}
