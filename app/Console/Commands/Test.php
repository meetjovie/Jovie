<?php

namespace App\Console\Commands;

use App\Events\ImportListCreated;
use App\Jobs\InstagramImport;
use App\Jobs\SendSlackNotification;
use App\Models\Creator;
use App\Models\Import;
use App\Models\User;
use App\Models\UserList;
use Aws\S3\S3Client;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use function Clue\StreamFilter\fun;
use Illuminate\Bus\Batch;
use Illuminate\Console\Command;
use Illuminate\Queue\Jobs\Job;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use League\Csv\Reader;
use League\Csv\Statement;
use Throwable;

class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test';

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
    const PER_PAGE = 500;

    protected $page = null;

    protected $path = null;

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
        $batches = Import::importBatches(1);
        $batches = !! count(array_filter($batches, function ($batch) {
            return $batch->is_batch && $batch->progress < 100;
        }));
        dd($batches);
        $list = UserList::firstOrCreateList(1, 'Twitch Leads - 10 Sample Profiles.csv', 1);
        if ($list->wasRecentlyCreated) {
            $dis = ImportListCreated::dispatch(1, $list);
        }
        dd(1);
//        $user = User::with('currentTeam.users')->where('id', 1)->first();
//        $teamUsers = $user->currentTeam->users->pluck('id')->toArray();
//dd($teamUsers);
        Schema::disableForeignKeyConstraints();
        $list = UserList::firstOrCreateList(1, 'large file 22');
        $creatorIds = [];
        $listId = $list->id;
        for ($i=1; $i<=1000000; $i++) {
            $creatorIds[] = [
                'user_list_id' => $listId,
                'creator_id' => $i
            ];
        }
        $creatorIds = collect($creatorIds);
        $chunks = $creatorIds->chunk(1000);
        foreach ($chunks as $k => $chunk) {
            $list->creators()->syncWithoutDetaching($chunk->toArray());
            dump($k);
            sleep(2);
        }
//        $list->creators()->sync($creatorIds);
//        $users = User::whereHas('pendingImports')->with('pendingImports')->get();
//        foreach ($users as $user) {
//            foreach ($user->pendingImports as $import) {
//                if ($import->instagram && $import->instagram_scrapped != 1) {
//                    // trigger instagram import
//                    $instagramBatch = $import->getImportBatch('instagram');
//                    if (! $instagramBatch->cancelled()) {
//                        $this->triggerInstagramImport($import, $instagramBatch);
//                    }
//                }
////                do this for each network
////                if ($import->twitter && $import->twitter_scrapped != 1) {
////                    // trigger instagram import
////                    $twitterBatch = $import->getImportBatch('twitter');
////                    if (! $twitterBatch->cancelled()) {
////                        $this->triggerTwitterImport($import, $twitterBatch);
////                    }
////                }
//            }
//        }
    }

    public function triggerTwitterImport($import, $twitterBatch)
    {
    }

    public function triggerInstagramImport($import, $batch)
    {
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
            'socialHandlers' => $socialHandlers,
        ];
        $tags = null;
        if ($import->tags && json_decode($import->tags)) {
            $tags = implode(',', json_decode($import->tags));
        }
        $batch->add([
            (new InstagramImport($import->instagram, $tags, true, null, $meta, $import->user_list_id, $import->user_id, $import->id))->delay(now()->addSeconds(1)),
        ]);
    }
}
