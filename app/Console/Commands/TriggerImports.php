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
use Illuminate\Support\Facades\DB;
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
//        $faileds = DB::table('failed_jobs')->get();
//        foreach ($faileds as $failed) {
//            $payload = json_decode($failed->payload);
//            $obj = unserialize($payload->data->command);
//            dump($obj->getUsername());
//        }
//        dd('---');
        // get first 100 importrs for each user in pipeline
        // if which networks it has
        // dispath batch in bus for each available network

        $users = User::whereHas('pendingImports')->with('pendingImports')->get();

//        $users = User::get();
//        foreach ($users as $user) {
//            $instagramImports = $user->pendingImportsByNetwork('instagram');
//            foreach ($instagramImports as $k => $import) {
//                if ($k == 0) {
//                    $instagramBatch = $import->getImportBatch('instagram');
//                }
//                $commonData = $this->setCommonDateForImport($import);
//                if (! $instagramBatch->cancelled() && is_null($instagramBatch->error_code)) { // we are not cancelling the batch now only pausing it in case of credits our or api limit. we set error_code in either case
//                    $this->triggerInstagramImport($import, $instagramBatch, $commonData);
//                    $import->instagram_dispatched = 1;
//                    $import->save();
//                }
//            }
//
//            $twitchImports = $user->pendingImportsByNetwork('twitch');
//            foreach ($twitchImports as $k => $import) {
//                if ($k == 0) {
//                    $twitchBatch = $import->getImportBatch('twitch');
//                }
//                $commonData = $this->setCommonDateForImport($import);
//                if (! $twitchBatch->cancelled() && is_null($twitchBatch->error_code)) { // we are not cancelling the batch now only pausing it in case of credits our or api limit. we set error_code in either case
//                    if (!Cache::has('twitch_token_'.$twitchBatch->user_list_id)) {
//                        Import::saveTwitchToken($twitchBatch->user_list_id);
//                    }
//                    $this->triggerTwitchImport($import, $twitchBatch, $commonData);
//                    $import->twitch_dispatched = 1;
//                    $import->save();
//                }
//            }
//        }
        foreach ($users as $user) {
            foreach ($user->pendingImports as $import) { // timwhite and timwwhiteT
                $dispatched = false;
                //fetch a creator that has instagram == timwhite OR twitch == timwhiteT
                // else create a new instance of creator new Creator()
                // after either of the above case runs we get a creator instance and we can pass that save creator instance to each network job of that single import
                //
                $commonData = $this->setCommonDateForImport($import);

                if ($import->instagram && $import->instagram_scrapped != 1) {
                    // trigger instagram import
                    $instagramBatch = $import->getImportBatch('instagram');
                    if (! $instagramBatch->cancelled()) {
                        $this->triggerInstagramImport($import, $instagramBatch, $commonData);
                        $import->instagram_dispatched = 1;
                        $import->save();
                        $dispatched = true;
                    }
                }
//                do this for each network
                if (($import->twitch || $import->twitch_id) && $import->twitch_scrapped != 1) {
                    // trigger instagram import
                    $twitchBatch = $import->getImportBatch('twitch');
                    if (! $twitchBatch->cancelled()) {
                        if (!Cache::has('twitch_token_'.$twitchBatch->user_list_id)) {
                            Import::saveTwitchToken($twitchBatch->user_list_id);
                        }
                        $this->triggerTwitchImport($import, $twitchBatch, $commonData);
                        $import->twitch_dispatched = 1;
                        $import->save();
                        $dispatched = true;
                    }
                }
                if (!$dispatched) {
                    Import::where('id', $import->id)->delete();
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
