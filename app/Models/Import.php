<?php

namespace App\Models;

use App\Traits\SocialScrapperTrait;
use Aws\S3\S3Client;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Statement;
use Throwable;

class Import extends Model
{
    use HasFactory, SocialScrapperTrait;

    protected $fillable = [
        'user_id',
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
    const ERROR_INTERNAL_NO_RESPONSE = 1;
    const ERROR_EXCEPTION_DURING_IMPORT = 2;

    public static function getProgress($batch)
    {
        $batch = DB::table('job_batches')->where('id', $batch->id)->first();
        if ($batch) {
            return $batch->initial_total_in_file > 0 ? round((self::processedImports($batch, $batch->user_list_id) / $batch->initial_total_in_file) * 100) : 0;
        }
    }

    public static function getSuccessfulCount($batch)
    {
        $batch = DB::table('job_batches')->where('id', $batch->id)->first();
        return ($batch->total_jobs - $batch->pending_jobs) - $batch->failed_jobs;
    }

    public static function processedImports($batch, $userListId)
    {
        $remainingInList = Import::where('user_list_id', $userListId)->where($batch->type, '!=', null)->count();
        return $batch->initial_total_in_file - $remainingInList;
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
        if (is_null($import)) return;
        $conditionInstagram = $import->instagram ? $import->instagram_scrapped : 1; // if no insta set scrapped condition as 1
        $conditionTwitch = ($import->twitch || $import->twitch_id) ? $import->twitch_scrapped : 1; // if no insta set scrapped condition as 1
        if ($import) {
            if ($conditionInstagram && $conditionTwitch) {
//                Log::info('deelte '.$importId);
                $import->delete();
            }
        }
    }

    public static function markImport($importId, $networks)
    {
        if ($importId) {
            Import::markNetworksAsScrapped($importId, $networks);
            Import::deleteImport($importId);
        }
    }

    public function getImportBatch($queue = 'instagram')
    {
        $batch = DB::table('job_batches')
            ->where('cancelled_at', null)
            ->where('finished_at', null)
            ->where('user_list_id', $this->user_list_id)->where('type', $queue)->first();
        if (is_null($batch)) {
            $batch = Bus::batch([
            ])->then(function (Batch $batch) {

                Log::info('All jobs completed successfully...');

            })->catch(function (Batch $batch, Throwable $e = null) {

                Log::info('First batch job failure detected...');

            })->finally(function (Batch $batch) {

                Log::info('The batch has finished executing...');

            })->onConnection($queue)->allowFailures()->dispatch();

            DB::table('job_batches')->where('id', $batch->id)->update([
                'user_list_id' => $this->user_list_id,
                'initial_total_in_file' => $queue != 'twitch' ? Import::where('user_list_id', $this->user_list_id)->whereNotNull($queue)->count() :
                    Import::where('user_list_id', $this->user_list_id)->where(function ($q) use($queue) {
                        $q->whereNotNull($queue)->orWhereNotNull($queue.'_id');
                    })->count(),
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

    public static function saveTwitchToken($listId = null)
    {
        $token = null;
        $response = Import::generateTwitchToken();
        if (!is_null($response) && $response->access_token) {
            $token = $response->access_token;
            Cache::put('twitch_token_'.$listId, $token, now()->addDay());
        }
        return $token;
    }

    public function setInstagramAttribute($value)
    {
        // Regex for verifying an instagram URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:instagram\.com|instagr\.am)\/([A-Za-z0-9-_\.]+)/im';

        // Verify valid Instagram URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['instagram'] =  $matches[1];
            return;
        }
        $regexUrl = '/(?:(?:http|https):\/\/)/';
        // Verify valid Instagram URL
        if ( preg_match( $regexUrl, $value, $matches ) ) {
            $this->attributes['instagram'] =  null;
            return;
        }
        $this->attributes['instagram'] = empty($value) ? null : $value;
    }

    public function setTiktokAttribute($value)
    {
        // Regex for verifying an tiktok URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:tiktok\.com)\/([\@|A-Za-z0-9-_\.]+)/';

        // Verify valid tiktok URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['tiktok'] = $matches[1];
            return;
        }
        $regexUrl = '/(?:(?:http|https):\/\/)/';
        // Verify valid Instagram URL
        if ( preg_match( $regexUrl, $value, $matches ) ) {
            $this->attributes['tiktok'] =  null;
            return;
        }
        $this->attributes['tiktok'] = empty($value) ? null : $value;
    }

    public function setOnlyFansAttribute($value)
    {
        // Regex for verifying an onlyFans URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:onlyfans\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid onlyFans URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['onlyFans'] = $matches[1];
            return;
        }
        $regexUrl = '/(?:(?:http|https):\/\/)/';
        // Verify valid Instagram URL
        if ( preg_match( $regexUrl, $value, $matches ) ) {
            $this->attributes['onlyFans'] =  null;
            return;
        }
        $this->attributes['onlyFans'] = empty($value) ? null : $value;
    }

    public function setLinkedinAttribute($value)
    {
        // Regex for verifying an linkedin URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:linkedin\.com\/)?(?:in)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid linkedin URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['linkedin'] = $matches[1];
            return;
        }
        $regexUrl = '/(?:(?:http|https):\/\/)/';
        // Verify valid Instagram URL
        if ( preg_match( $regexUrl, $value, $matches ) ) {
            $this->attributes['linkedin'] =  null;
            return;
        }
        $this->attributes['linkedin'] = empty($value) ? null : $value;
    }

    public function setTwitterAttribute($value)
    {
        // Regex for verifying a twitter URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitter\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid twitter URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['twitter'] = $matches[1];
            return;
        }
        $regexUrl = '/(?:(?:http|https):\/\/)/';
        // Verify valid Instagram URL
        if ( preg_match( $regexUrl, $value, $matches ) ) {
            $this->attributes['twitter'] =  null;
            return;
        }
        $this->attributes['twitter'] = empty($value) ? null : $value;
    }

    public function setSnapchatAttribute($value)
    {
        // Regex for verifying a snapchat URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:snapchat\.com\/)?(?:add)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid snapchat URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['snapchat'] = $matches[1];
            return;
        }
        $regexUrl = '/(?:(?:http|https):\/\/)/';
        // Verify valid Instagram URL
        if ( preg_match( $regexUrl, $value, $matches ) ) {
            $this->attributes['snapchat'] =  null;
            return;
        }
        $this->attributes['snapchat'] = empty($value) ? null : $value;
    }

    public function setTwitchAttribute($value)
    {
        // Regex for verifying a twitch URL
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:twitch\.tv|twitch\.com)\/([A-Za-z0-9-_\.]+)/';

        // Verify valid twitch URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $this->attributes['twitch'] = $matches[1];
            return;
        }
        $regexUrl = '/(?:(?:http|https):\/\/)/';
        // Verify valid Instagram URL
        if ( preg_match( $regexUrl, $value, $matches ) ) {
            $this->attributes['twitch'] =  null;
            return;
        }
        $this->attributes['twitch'] = empty($value) ? null : $value;
    }

    public function getYoutubeAttribute($value)
    {
        if (is_null($value)) {
            return json_decode('{}');
        }
        return json_decode($value ?? '{}');
    }

    public function setYoutubeAttribute($value)
    {
        $oldYoutube = $this->youtube;
        if (!count((array) $value)) {
            return $oldYoutube;
        }
        // Regex for verifying a youtube URL - channel id
        $regex = '/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:channel)\/([A-Za-z0-9-_\.]+)/';
        // Verify valid youtube URL
        if ( preg_match( $regex, $value, $matches ) ) {
            $oldYoutube->channel_id = $matches[1];
            $this->attributes['youtube'] = json_encode($oldYoutube);
        }
        // Regex for verifying a youtube URL - channel name
        elseif ( preg_match( '/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:c)\/([A-Za-z0-9-_\.]+)/', $value, $matches ) ) {
            $oldYoutube->channel_name = $matches[1];
            $this->attributes['youtube'] = json_encode($oldYoutube);
        }
        elseif ( preg_match( '/(?:(?:http|https):\/\/)?(?:www\.)?(?:youtube\.com\/)?(?:user)\/([A-Za-z0-9-_\.]+)/', $value, $matches ) ) {
            $oldYoutube->channel_name = $matches[1];
            $this->attributes['youtube'] = json_encode($oldYoutube);
        }

        elseif (in_array(substr($value, 0, 2), ['UC', 'HC'])) {
            $oldYoutube->channel_id = $value;
            $this->attributes['youtube'] = json_encode($oldYoutube);
        } else {
            $oldYoutube->channel_name = $value;
            $this->attributes['youtube'] = json_encode($oldYoutube);
        }
    }
}
