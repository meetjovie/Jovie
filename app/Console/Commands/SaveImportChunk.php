<?php

namespace App\Console\Commands;

use App\Models\Import;
use App\Models\User;
use App\Models\UserList;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;

class SaveImportChunk extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'save:import-chunk {path} {page} {payload}';

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
        try {
            $path = $this->argument('path');
            $page = $this->argument('page');
            $payload = json_decode(base64_decode($this->argument('payload')));

            $stream = Import::getStream($path);
            $reader = Reader::createFromStream($stream);
            $records = Import::records($reader, $page);
            $list = UserList::firstOrCreateList($payload->userId, $payload->listName, $payload->teamId);
            $usStates = (array) json_decode(file_get_contents('https://gist.githubusercontent.com/mshafrir/2646763/raw/8b0dbb93521f5d6889502305335104218454c2bf/states_hash.json'));
            $user = User::where('id', $payload->userId)->first();

            $bar = $this->output->createProgressBar(count($records));
            $bar->start();

            $imports = [];
            $mappedColumns = collect($payload->mappedColumns);
            $maxColumn = max($mappedColumns->flatten()->toArray());
            foreach ($records as $offset => $row) {
                $import = new Import();
                if ($page == 0 && $offset == 0) {
                    $bar->advance();
                    continue;
                }

                if (count($row) < $maxColumn) {
                    $missColumnCount = $maxColumn - count($row);
                    for ($i = 0; $i <= $missColumnCount; $i++) {
                        array_push($row, null);
                    }
                }

                $socialHandlers = [
                    'twitch_handler' => isset($payload->mappedColumns->twitch) ? $row[$payload->mappedColumns->twitch] : null,
                    'twitch_id' => isset($payload->mappedColumns->twitchId) ? $row[$payload->mappedColumns->twitchId] : null,
                    'onlyFans_handler' => isset($payload->mappedColumns->onlyFans) ? $row[$payload->mappedColumns->onlyFans] : null,
                    'snapchat_handler' => isset($payload->mappedColumns->snapchat) ? $row[$payload->mappedColumns->snapchat] : null,
                    'linkedin_handler' => isset($payload->mappedColumns->linkedin) ? $row[$payload->mappedColumns->linkedin] : null,
                    'youtube_handler' => isset($payload->mappedColumns->youtube) ? $row[$payload->mappedColumns->youtube] : null,
                    'twitter_handler' => isset($payload->mappedColumns->twitter) ? $row[$payload->mappedColumns->twitter] : null,
                    'tiktok_handler' => isset($payload->mappedColumns->tiktok) ? $row[$payload->mappedColumns->tiktok] : null,
                    'instagram_handler' => isset($payload->mappedColumns->instagram) ? $row[$payload->mappedColumns->instagram] : null,
                ];

                if (! count(array_filter($socialHandlers))) {
                    $bar->advance();
                    continue;
                }

                $emails = [];
                if (isset($payload->mappedColumns->emails)) {
                    foreach ($payload->mappedColumns->emails as $emailKey) {
                        if ($row[$emailKey]) {
                            $emails[] = $row[$emailKey];
                        }
                    }
                }

                // instagram
                $country = isset($payload->mappedColumns->country) ? $row[$payload->mappedColumns->country] : null;
                if (isset($payload->mappedColumns->country) && $country && in_array(strtolower(trim($row[$payload->mappedColumns->country])), array_map('strtolower', $usStates))) {
                    $country = 'United States';
                }

                $import->user_id = $list->user_id;
                $import->user_list_id = $list->id;
                if ($payload->tags) {
                    $tags = explode(',', $payload->tags);
                    $import->tags = json_encode(array_values(array_map('trim', $tags)));
                }
                $import->first_name = isset($payload->mappedColumns->firstName) ? $row[$payload->mappedColumns->firstName] : null;
                $import->last_name = isset($payload->mappedColumns->lastName) ? $row[$payload->mappedColumns->lastName] : null;
                $import->city = isset($payload->mappedColumns->lastName) ? $row[$payload->mappedColumns->lastName] : null;
                $import->country = $country;

                $instaFollowersCount = isset($payload->mappedColumns->instagramFollowersCount) ? $row[$payload->mappedColumns->instagramFollowersCount] : 5001;

                // if no follower count then let go
                if (isset($payload->mappedColumns->instagram) && ($user->is_admin || $instaFollowersCount > 5000)) {
                    $import->instagram = $row[$payload->mappedColumns->instagram] ?? null;
                    if (! empty($import->instagram) && $import->instagram[0] == '@') {
                        $import->instagram = substr($import->instagram, 1);
                    }
                }

                $youtubeFollowersCount = isset($payload->mappedColumns->youtubeFollowersCount) ? $row[$payload->mappedColumns->youtubeFollowersCount] : 1001;
                if (isset($payload->mappedColumns->youtube) && ($user->is_admin || $youtubeFollowersCount > 1000)) {
                    $import->youtube = $row[$payload->mappedColumns->youtube] ?? null;
                }

                $import->twitter = isset($payload->mappedColumns->twitter) ? $row[$payload->mappedColumns->twitter] : null;
                $import->twitch = isset($payload->mappedColumns->twitch) ? $row[$payload->mappedColumns->twitch] : null;
                $import->twitch_id = isset($payload->mappedColumns->twitchId) ? $row[$payload->mappedColumns->twitchId] : null;
                $import->onlyFans = isset($payload->mappedColumns->onlyFans) ? $row[$payload->mappedColumns->onlyFans] : null;
                $import->tiktok = isset($payload->mappedColumns->tiktok) ? $row[$payload->mappedColumns->tiktok] : null;
                $import->linkedin = isset($payload->mappedColumns->linkedin) ? $row[$payload->mappedColumns->linkedin] : null;
                $import->snapchat = isset($payload->mappedColumns->snapchat) ? $row[$payload->mappedColumns->snapchat] : null;
                $import->wikiId = isset($payload->mappedColumns->wikiId) ? $row[$payload->mappedColumns->wikiId] : null;
                $import->gender = isset($payload->mappedColumns->gender) ? $row[$payload->mappedColumns->gender] : null;
                $import->phone = isset($payload->mappedColumns->phone) ? $row[$payload->mappedColumns->phone] : null;
                $import->emails = json_encode($emails);
                $import->social_handlers = json_encode($socialHandlers);
                $import->save();
//                array_push($imports, $data);
                $bar->advance();
            }
//            Import::query()->insert($imports);
            $bar->finish();
        } catch (\Exception $e) {
            Log::info($e->getMessage().' = '.$e->getLine());
        }
    }
}
