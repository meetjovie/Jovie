<?php

namespace App\Jobs;

use App\Imports\ImportFileImport;
use App\Models\Import;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PharIo\Version\Exception;

class SaveImport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;
    private $mappedColumns;
    private $tags;
    private $listName;
    private $userId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $mappedColumns, $tags, $listName, $userId)
    {
        $this->file = $file;
        $this->mappedColumns = $mappedColumns;
        $this->tags = $tags;
        $this->listName = $listName;
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

            if (count($results) > 1) {
                $results = $results->toArray();
                array_shift($results);

                foreach ($results as $k => $row) {
                    $socialHandlers = [
                        'twitch_handler' => isset($this->mappedColumns->twitch) ? $row[$this->mappedColumns->twitch] : null,
                        'onlyFans_handler' => isset($this->mappedColumns->onlyFans) ? $row[$this->mappedColumns->onlyFans] : null,
                        'snapchat_handler' => isset($this->mappedColumns->snapchat) ? $row[$this->mappedColumns->snapchat] : null,
                        'linkedin_handler' => isset($this->mappedColumns->linkedin) ? $row[$this->mappedColumns->linkedin] : null,
                        'youtube_handler' => isset($this->mappedColumns->youtube) ? $row[$this->mappedColumns->youtube] : null,
                        'twitter_handler' => isset($this->mappedColumns->twitter) ? $row[$this->mappedColumns->twitter] : null,
                        'tiktok_handler' => isset($this->mappedColumns->tiktok) ? $row[$this->mappedColumns->tiktok] : null,
                        'instagram_handler' => isset($this->mappedColumns->instagram) ? $row[$this->mappedColumns->instagram] : null,
                    ];

                    $emails = [];
                    if (isset($this->mappedColumns->emails)) {
                        foreach ($this->mappedColumns->emails as $emailKey) {
                            if ($row[$emailKey]) {
                                $emails[] = $row[$emailKey];
                            }
                        }
                    }

                    // instagram
                    $user = User::where('id', $this->userId)->first();

                    $country = isset($this->mappedColumns->country) ? $row[$this->mappedColumns->country] : null;
                    $usStates = (array) json_decode(file_get_contents('https://gist.githubusercontent.com/mshafrir/2646763/raw/8b0dbb93521f5d6889502305335104218454c2bf/states_hash.json'));
                    if ($this->mappedColumns->country && $country && in_array(strtolower(trim($row[$this->mappedColumns->country])), array_map('strtolower', $usStates))) {
                        $country = 'United States';
                    }

                    $youtubeFollowersCountKey = $this->mappedColumns->youtubeFollowersCount ?? null;

                    $import = new Import();
                    $import->list_name = $this->listName;
                    if ($this->tags) {
                        $tags = explode(',', $this->tags);
                        $import->tags = json_encode(array_values(array_map('trim', $tags)));
                    }
                    $import->first_name = isset($this->mappedColumns->firstName) ? $row[$this->mappedColumns->firstName] : null;
                    $import->last_name = isset($this->mappedColumns->lastName) ? $row[$this->mappedColumns->lastName] : null;
                    $import->city = isset($this->mappedColumns->lastName) ? $row[$this->mappedColumns->lastName] : null;
                    $import->country = $country;

                    $instaFollowersCount = isset($this->mappedColumns->instagramFollowersCount) ? $row[$this->mappedColumns->instagramFollowersCount] : 5001;
                    // if no follower count then let go

                    if (isset($this->mappedColumns->instagram) && ($user->is_admin || $instaFollowersCount > 5000)) {
                        $import->instagram = $row[$this->mappedColumns->instagram];
                    }

                    $youtubeFollowersCount = isset($this->mappedColumns->youtubeFollowersCount) ? $row[$this->mappedColumns->youtubeFollowersCount] : 1001;
                    if (isset($this->mappedColumns->youtube) && ($user->is_admin || $youtubeFollowersCount > 1000)) {
                        $import->youtube = $row[$this->mappedColumns->youtube];
                    }

                    $import->twitter = isset($this->mappedColumns->twitter) ? $row[$this->mappedColumns->twitter] : null;
                    $import->twitch = isset($this->mappedColumns->twitch) ? $row[$this->mappedColumns->twitch] : null;
                    $import->onlyFans = isset($this->mappedColumns->onlyFans) ? $row[$this->mappedColumns->onlyFans] : null;
                    $import->tiktok = isset($this->mappedColumns->tiktok) ? $row[$this->mappedColumns->tiktok] : null;
                    $import->linkedin = isset($this->mappedColumns->linkedin) ? $row[$this->mappedColumns->linkedin] : null;
                    $import->snapchat = isset($this->mappedColumns->snapchat) ? $row[$this->mappedColumns->snapchat] : null;
                    $import->wikiId = isset($this->mappedColumns->wikiId) ? $row[$this->mappedColumns->wikiId] : null;
                    $import->gender = isset($this->mappedColumns->gender) ? $row[$this->mappedColumns->gender] : null;
                    $import->phone = isset($this->mappedColumns->phone) ? $row[$this->mappedColumns->phone] : null;
                    $import->emails = json_encode($emails);
                    $import->social_handlers = json_encode($socialHandlers);

                    $import->save();
                }
            }
        } catch (Exception $e) {
            SendSlackNotification::dispatch(('Error saving file for user '.$this->userId.' for file '.$this->file), ('Error on Youtube Import '.$e->getMessage().'----'. $e->getFile(). '-----'.$e->getLine()), [
                'file' => $this->file,
                'mappedColumns' => $this->mappedColumns,
                'tags' => $this->tags,
                'fileName' => $this->fileName,
                'userId' => $this->userId,
            ]);
        } finally {
            User::where('id', $this->userId)->decrement('queued_count');
        }
    }
}
