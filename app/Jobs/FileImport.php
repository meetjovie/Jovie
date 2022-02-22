<?php

namespace App\Jobs;

use App\Imports\ImportFileImport;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PHPUnit\Exception;

class FileImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;
    private $mappedColumns;
    private $tags;
    private $listId;
    private $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $mappedColumns, $tags, $listId, $userId)
    {
        $this->file = $file;
        $this->mappedColumns = $mappedColumns;
        $this->tags = $tags;
        $this->listId = $listId;
        $this->userId = $userId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $fileImport = new ImportFileImport();
            Excel::import($fileImport, $this->file, 's3', \Maatwebsite\Excel\Excel::CSV); // file is now loaded in results, so don't need it
            $results = $fileImport->data;
            Storage::disk('s3')->delete($this->file);
            $instagramKey = null;
            $youtubeKey = null;
            $emailKeys = [];
            $instagramFollowerCountKey = null;
            $youtubeFollowersCountKey = null;
            if (count($results) > 1) {
                $results = $results->toArray();
                $headers = $results[0];
                if (isset($this->mappedColumns->instagram)) {
                    $instagramKey = array_search($this->mappedColumns->instagram, $headers);
                }
                if (isset($this->mappedColumns->youtube)) {
                    $youtubeKey = array_search($this->mappedColumns->youtube, $headers);
                }
                if (isset($this->mappedColumns->emails) && count($this->mappedColumns->emails)) {
                    foreach ($this->mappedColumns->emails as $emailKey) {
                        $emailKeys[] = array_search($emailKey, $headers);
                    }
                }
                if (isset($this->mappedColumns->instagramFollowersCount)) {
                    $instagramFollowerCountKey = array_search($this->mappedColumns->instagramFollowersCount, $headers);
                }
                if (isset($this->mappedColumns->youtubeFollowersCount)) {
                    $youtubeFollowersCountKey = array_search($this->mappedColumns->youtubeFollowersCount, $headers);
                }
                array_shift($results);
                foreach ($results as $k => $row) {
                    $emails = [];
                    foreach ($emailKeys as $emailKey) {
                        if ($row[$emailKey]) {
                            $emails[] = $row[$emailKey];
                        }
                    }
                    // instagram
                    $user = User::where('id', $this->userId)->first();
                    $instaFollowersCount = $row[$instagramFollowerCountKey] ?? 5001; // if no follower count then let go
                    if (!is_null($instagramKey) && ($instaFollowersCount > 5000 || ($user->is_admn ?? 0))) {
                        $username = $row[$instagramKey];
                        if ($username && $username != '') {
                            if ($username[0] == '@') {
                                $username = substr($username, 1);
                            }
                            Bus::chain([
                                new InstagramImport($username, $this->tags, true, null, $emails, $this->listId, $this->userId),
                                new SendSlackNotification('imported instagram user '.$username)
                            ])->dispatch();
                        }
                    }
                    // youtube
//                    $youtubeFollowersCount = $row[$youtubeFollowersCountKey] ?? 1001; // if no follower count then let go
//                    if (!is_null($youtubeKey) && $youtubeFollowersCount > 1000) {
//                        $youtubeUrl = $row[$youtubeKey];
//                        if ($youtubeUrl && $youtubeUrl != '') {
//                            YoutubeImport::dispatch($youtubeUrl, $this->tags, $email);
//                        }
//                    }
                }
            }
        } catch (\Exception $e) {
            //            SendSlackNotification::dispatch('Error on Youtube Import '.$e->getMessage().'----'. $e->getFile(). '-----'.$e->getLine());
        }
    }
}
