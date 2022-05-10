<?php

namespace App\Models;

use Aws\S3\S3Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

    public static function getProgress($batch)
    {
        $batch = DB::table('job_batches')->where('id', $batch->id)->first();
        if ($batch) {
            $totalExpectedJobs = Import::where('user_list_id', $batch->user_list_id)->count();
            return $totalExpectedJobs > 0 ? round((self::pendingImports($batch) / $totalExpectedJobs) * 100) : 0;
        }

    }

    public static function pendingImports($batch)
    {
        $batch = DB::table('job_batches')->where('id', $batch->id)->first();
        if ($batch) {
            $totalExpectedJobs = Import::where('user_list_id', $batch->user_list_id)->count();
            return $totalExpectedJobs - $batch->pending_jobs;
        }
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

    public static function deleteImport($importId)
    {
        $import = Import::where('id', $importId)->first();
        if ($import) {
            if (
                $import->instagram && $import->instagram_scrapped
            ) {
                Log::info('deelte '.$importId);
//                $import->delete();
            }
        }
    }
}
