<?php

namespace App\Models;

use Aws\S3\S3Client;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Statement;
use Throwable;

class Import extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_list_id',
        'tags',
        'first_name',
        'last_name',
        'city',
        'country',
        'instagram',
        'youtube',
        'twitter',
        'twitch',
        'onlyFans',
        'tiktok',
        'linkedin',
        'snapchat',
        'wikiId',
        'social_handlers',
        'phone',
        'gender',
    ];

    const PER_PAGE = 1000;

    const ERROR_INTERNAL_MONTHLY_CREDITS_REACHED = 0;
    const ERROR_EXCEPTION_DURING_IMPORT = 1;

    public static function getProgress($batch)
    {
        $batch = DB::table('job_batches')->where('id', $batch->id)->first();
        if ($batch) {
            return $batch->initial_total_in_file > 0 ? round((self::processedImports($batch, $batch->user_list_id) / $batch->initial_total_in_file) * 100) : 0;
        }
    }

    public static function processedImports($batch, $userListId)
    {
        $remainingInList = UserList::where('id', $userListId)->count();
        return $batch->initial_total_in_file - ($batch->initial_total_in_file - $remainingInList);
    }

    public function getEmailsAttribute($value)
    {
        return json_decode($value);
    }

    public function getSocialHandlersAttribute($value)
    {
        return json_decode($value);
    }

    public static function getStream($path)
    {
        $client = new S3Client(array_merge(config('filesystems.disks.s3'), [
            'version' => 'latest'
        ]));
        $client->registerStreamWrapper();
        // Now we can use the s3:// protocol.
        $path = ('s3://' . config('filesystems.disks.s3.bucket') . '/' . $path);
        // Return the stream.
        return fopen($path, 'r', false, stream_context_create([
            's3' => ['seekable' => true]
        ]));
    }

    public static function markNetworksAsScrapped($importId, array $networks)
    {
        $scrapped = [];
        foreach ($networks as $network) {
            $scrapped[$network.'_scrapped'] = 1;
        }
        return Import::where('id', $importId)->update($scrapped);
    }

    public static function deleteImport($importId)
    {
        $import = Import::where('id', $importId)->first();
        if ($import) {
            if (
                $import->instagram && $import->instagram_scrapped
            ) {
//                Log::info('deelte '.$importId);
                $import->delete();
            }
        }
    }

    public function getImportBatch($queue = 'instagram')
    {
        $batch = DB::table('job_batches')->where('user_list_id', $this->user_list_id)->where('type', $queue)->first();
        if (is_null($batch)) {
            $batch = Bus::batch([
            ])->then(function (Batch $batch) {

                Log::info('All jobs completed successfully...');

            })->catch(function (Batch $batch, Throwable $e) {

                Log::info('First batch job failure detected...');

            })->finally(function (Batch $batch) {

                Log::info('The batch has finished executing...');

            })->onConnection($queue)->dispatch();

            DB::table('job_batches')->where('id', $batch->id)->update([
                'user_list_id' => $this->user_list_id,
                'initial_total_in_file' => Import::where('user_list_id', $this->user_list_id)->whereNotNull($queue)->count(),
                'type' => $queue
            ]);
        } else {
            $batch = Bus::findBatch($batch->id);
        }
        return $batch;
    }

    public static function records($reader, $page, $limit = Import::PER_PAGE)
    {
        return (new Statement)
            ->offset($page * $limit)
            ->limit($limit)
            ->process($reader);
    }
}
