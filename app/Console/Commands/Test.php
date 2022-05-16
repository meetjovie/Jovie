<?php

namespace App\Console\Commands;

use App\Jobs\InstagramImport;
use App\Jobs\SendSlackNotification;
use App\Models\Creator;
use App\Models\Import;
use App\Models\User;
use Aws\S3\S3Client;
use Carbon\Carbon;
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
use function Clue\StreamFilter\fun;

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
        $users = User::whereHas('pendingImports')->with('pendingImports')->get();
        foreach ($users as $user) {
            dd($user->pendingImports->pluck('id')->toArray());
            foreach ($user->pendingImports as $import) {
                $batch = $this->getBatch($import);
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

    public function getBatch($import)
    {
        $batch = DB::table('job_batches')->where('user_list_id', $import->user_list_id)->first();
        if (is_null($batch)) {
            $batch = Bus::batch([
            ])->then(function (Batch $batch) {

                Log::info('All jobs completed successfully...');

            })->catch(function (Batch $batch, Throwable $e) {

                Log::info('First batch job failure detected...');

            })->finally(function (Batch $batch) {

                Log::info('The batch has finished executing...');

            })->allowFailures()->onConnection('instagram')->dispatch();

            DB::table('job_batches')->where('id', $batch->id)->update([
                'user_list_id' => $import->user_list_id,
                'initial_total_in_file' => Import::where('user_list_id', $import->user_list_id)->count()
            ]);
        } else {
            $batch = Bus::findBatch($batch->id);
        }
        return $batch;
    }
}
