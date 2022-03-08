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
            $twitchKey = null;
            $onlyFansKey = null;
            $snapchatKey = null;
            $linkedinKey = null;
            $youtubeKey = null;
            $twitterKey = null;
            $tiktokKey = null;
            $emailKeys = [];
            $instagramFollowerCountKey = null;
            $youtubeFollowersCountKey = null;
            $firstNameKey = null;
            $lastNameKey = null;
            $cityKey = null;
            $countryKey = null;
            $wikiKey = null;
            if (count($results) > 1) {
                $results = $results->toArray();
                $headers = $results[0];
                $twitchKey = isset($this->mappedColumns->twitch) ? array_search($this->mappedColumns->twitch, $headers) : null;
                $onlyFansKey = isset($this->mappedColumns->onlyFans) ? array_search($this->mappedColumns->onlyFans, $headers) : null;
                $snapchatKey = isset($this->mappedColumns->snapchat) ? array_search($this->mappedColumns->snapchat, $headers) : null;
                $linkedinKey = isset($this->mappedColumns->linkedin) ? array_search($this->mappedColumns->linkedin, $headers) : null;
                $youtubeKey = isset($this->mappedColumns->youtube) ? array_search($this->mappedColumns->youtube, $headers) : null;
                $twitterKey = isset($this->mappedColumns->twitter) ? array_search($this->mappedColumns->twitter, $headers) : null;
                $tiktokKey = isset($this->mappedColumns->tiktok) ? array_search($this->mappedColumns->tiktok, $headers) : null;

                if (isset($this->mappedColumns->firstName)) {
                    $firstNameKey = array_search($this->mappedColumns->firstName, $headers);
                }
                if (isset($this->mappedColumns->lastName)) {
                    $lastNameKey = array_search($this->mappedColumns->lastName, $headers);
                }
                if (isset($this->mappedColumns->city)) {
                    $cityKey = array_search($this->mappedColumns->city, $headers);
                }
                if (isset($this->mappedColumns->country)) {
                    $countryKey = array_search($this->mappedColumns->country, $headers);
                }
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
                if (isset($this->mappedColumns->wikiId)) {
                    $wikiKey = array_search($this->mappedColumns->wikiId, $headers);
                }
                array_shift($results);
                foreach ($results as $k => $row) {
                    $socialHandlers = [
                        'twitch_handler' => $twitchKey ? $row[$twitchKey] : null,
                        'onlyFans_handler' => $onlyFansKey ? $row[$onlyFansKey] : null,
                        'snapchat_handler' => $snapchatKey ? $row[$snapchatKey] : null,
                        'linkedin_handler' => $linkedinKey ? $row[$linkedinKey] : null,
                        'youtube_handler' => $youtubeKey ? $row[$youtubeKey] : null,
                        'twitter_handler' => $twitterKey ? $row[$twitterKey] : null,
                        'tiktok_handler' => $tiktokKey ? $row[$tiktokKey] : null,
                        'instagram_handler' => $instagramKey ? $row[$instagramKey] : null,
                    ];
                    $emails = [];
                    foreach ($emailKeys as $emailKey) {
                        if ($row[$emailKey]) {
                            $emails[] = $row[$emailKey];
                        }
                    }
                    // instagram
                    $user = User::where('id', $this->userId)->first();
                    $instaFollowersCount = $row[$instagramFollowerCountKey] ?? 5001; // if no follower count then let go
                    if (!is_null($instagramKey) && ($user->is_admin || $instaFollowersCount > 5000)) {
                        $username = $row[$instagramKey];
                        if ($username && $username != '') {
                            if ($username[0] == '@') {
                                $username = substr($username, 1);
                            }
                            $country = $row[$countryKey] ?? null;
                            $usStates = (array) json_decode(file_get_contents('https://gist.githubusercontent.com/mshafrir/2646763/raw/8b0dbb93521f5d6889502305335104218454c2bf/states_hash.json'));
                            if ($countryKey && $row[$countryKey] && in_array(strtolower(trim($row[$countryKey])), array_map('strtolower', $usStates))) {
                                $country = 'United States';
                            }
                            $meta = [
                                'emails' => $emails,
                                'firstName' => ($row[$firstNameKey] ?? null),
                                'lastName' => ($row[$lastNameKey] ?? null),
                                'city' => ($row[$cityKey] ?? null),
                                'country' => $country,
                                'wikiId' => ($row[$wikiKey] ?? null),
                                'socialHandlers' => $socialHandlers
                            ];
                            Bus::chain([
                                new InstagramImport($username, $this->tags, true, null, $meta, $this->listId, $this->userId),
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
//            dd($e->getMessage(), $e->getLine());
            //            SendSlackNotification::dispatch('Error on Youtube Import '.$e->getMessage().'----'. $e->getFile(). '-----'.$e->getLine());
        }
    }
}
