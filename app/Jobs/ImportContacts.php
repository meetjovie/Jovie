<?php

namespace App\Jobs;

use App\Events\UserListImported;
use App\Models\Contact;
use App\Models\Import;
use App\Models\User;
use App\Models\UserList;
use App\Models\Team;
use App\Traits\SocialScrapperTrait;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use League\Csv\Reader;

class ImportContacts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    use SocialScrapperTrait;

    private $file;
    private $page;

    private $socialHandlersFromSocialColumn = [];

    private mixed $payload;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($file, $page, $payload)
    {
        $this->file = $file;
        $this->page = $page;
        $this->payload = json_decode(base64_decode($payload));
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $stream = Import::getStream($this->file);
            $reader = Reader::createFromStream($stream);
            $records = Import::records($reader, $this->page);

            $usStates = (array)json_decode(
                file_get_contents(
                    'https://gist.githubusercontent.com/mshafrir/2646763/raw/8b0dbb93521f5d6889502305335104218454c2bf/states_hash.json'
                )
            );

            $mappedColumns = collect($this->payload->mappedColumns);
            $maxColumn = max($mappedColumns->flatten()->toArray());
            $contactIds = [];
            foreach ($records as $offset => $row) {
                if ($this->page == 0 && $offset == 0) {
                    continue;
                }

                if (count($row) < $maxColumn) {
                    $missColumnCount = $maxColumn - count($row);
                    for ($i = 0; $i <= $missColumnCount; $i++) {
                        array_push($row, null);
                    }
                }

                $emails = [];
                if (isset($this->payload->mappedColumns->emails)) {
                    foreach ($this->payload->mappedColumns->emails as $emailKey) {
                        if ($row[$emailKey]) {
                            $emails[] = $row[$emailKey];
                        }
                    }
                }

                // instagram
                $country = isset($this->payload->mappedColumns->country) ? $row[$this->payload->mappedColumns->country] : null;
                if (isset($this->payload->mappedColumns->country) && $country && in_array(
                        strtolower(trim($row[$this->payload->mappedColumns->country])),
                        array_map('strtolower', $usStates)
                    )) {
                    $country = 'United States';
                }

                $contact = null;
                $contact['team_id'] = $this->payload->teamId;
                $contact['user_id'] = $this->payload->userId;
                $contact['user_list_id'] = $this->payload->list->id;
                if ($this->payload->tags) {
                    $tags = explode(',', $this->payload->tags);
                    $contact['tags'] = json_encode(array_values(array_map('trim', $tags)));
                }
                $contact['first_name'] = isset($this->payload->mappedColumns->firstName) ? $row[$this->payload->mappedColumns->firstName] : null;
                $contact['last_name'] = isset($this->payload->mappedColumns->lastName) ? $row[$this->payload->mappedColumns->lastName] : null;
                $contact['full_name'] = ($contact['first_name'] . ' ' . $contact['last_name']);
                $contact['nickname'] = isset($this->payload->mappedColumns->nickname) ? $row[$this->payload->mappedColumns->nickname] : null;
                $contact['suffix'] = isset($this->payload->mappedColumns->suffix) ? $row[$this->payload->mappedColumns->suffix] : null;
                $contact['company'] = isset($this->payload->mappedColumns->company) ? $row[$this->payload->mappedColumns->company] : null;
                $contact['department'] = isset($this->payload->mappedColumns->department) ? $row[$this->payload->mappedColumns->department] : null;
                $contact['title'] = isset($this->payload->mappedColumns->title) ? $row[$this->payload->mappedColumns->title] : null;
                $contact['phones'] = isset($this->payload->mappedColumns->phone) ? $row[$this->payload->mappedColumns->phone] : null;
                $contact['website'] = isset($this->payload->mappedColumns->website) ? $row[$this->payload->mappedColumns->website] : null;
                $contact['gender'] = isset($this->payload->mappedColumns->gender) ? $row[$this->payload->mappedColumns->gender] : null;

                if (empty($contact['gender'])) {
                    $genderResponse = self::getUserGender($contact['full_name']);
                    $contact['gender'] = $genderResponse->gender ?? null;
                }

                $contact['emails'] = $emails;
                $contact['city'] = isset($this->payload->mappedColumns->lastName) ? $row[$this->payload->mappedColumns->lastName] : null;
                $contact['country'] = $country;

                if (isset($this->payload->mappedColumns->socials)) {
                    $this->socialHandlersFromSocialColumn = $this->loadSocialFromOneColumn($row[$this->payload->mappedColumns->socials]);
                }

                $contact['instagram'] = $this->setSocialColumn('instagram', $this->payload->mappedColumns, $row);
                if (!empty($contact['instagram']) && $contact['instagram'][0] == '@') {
                    $contact['instagram'] = substr($contact['instagram'], 1);
                }

                $contact['youtube'] = $this->setSocialColumn('youtube', $this->payload->mappedColumns, $row);
//                    isset($this->payload->mappedColumns->youtube) ? $row[$this->payload->mappedColumns->youtube] : null;
                $contact['twitter'] = $this->setSocialColumn('twitter', $this->payload->mappedColumns, $row);
//                    isset($this->payload->mappedColumns->twitter) ? $row[$this->payload->mappedColumns->twitter] : null;
                $contact['twitch'] = $this->setSocialColumn('twitch', $this->payload->mappedColumns, $row);
//                    isset($this->payload->mappedColumns->twitch) ? $row[$this->payload->mappedColumns->twitch] : null;
                $contact['onlyFans'] = $this->setSocialColumn('onlyFans', $this->payload->mappedColumns, $row);
//                    isset($this->payload->mappedColumns->onlyFans) ? $row[$this->payload->mappedColumns->onlyFans] : null;
                $contact['tiktok'] = $this->setSocialColumn('tiktok', $this->payload->mappedColumns, $row);
//                    isset($this->payload->mappedColumns->tiktok) ? $row[$this->payload->mappedColumns->tiktok] : null;
                $contact['linkedin'] = $this->setSocialColumn('linkedin', $this->payload->mappedColumns, $row);
//                    isset($this->payload->mappedColumns->linkedin) ? $row[$this->payload->mappedColumns->linkedin] : null;
                $contact['snapchat'] = $this->setSocialColumn('snapchat', $this->payload->mappedColumns, $row);
//                    isset($this->payload->mappedColumns->snapchat) ? $row[$this->payload->mappedColumns->snapchat] : null;
                $contact['wiki'] = $this->setSocialColumn('wiki', $this->payload->mappedColumns, $row);
//                    isset($this->payload->mappedColumns->wiki) ? $row[$this->payload->mappedColumns->wiki] : null;
                $contact = Contact::saveContact($contact, $this->payload->list->id)->first();


                $mappedColumns = get_object_vars($this->payload->mappedColumns);
                $customKeys = array_filter(array_keys($mappedColumns), function ($key) {
                    return strpos($key, "custom") !== false;
                });

                $data = [];
                foreach ($customKeys as $customKey) {
                    $data[$customKey] = $row[$this->payload->mappedColumns->$customKey];
                }
                if (count($data)) {
                    $data['team_id'] = $this->payload->teamId;
                    $data['user_id'] = $this->payload->userId;
                    Contact::updateCustomFields($data, $contact);
                }

                $team = Team::find($contact->team_id);
                if ($this->payload->autoEnrich == "true" || $team->autoEnrichImportEnabled()) {
                    $contact->enrichContact();
                }
            }

            if ($this->page >= ceil($this->payload->totalRecords / Import::PER_PAGE) - 1) {
                if ($this->payload->list) {
                    $list = UserList::query()->where('id', $this->payload->list->id)->first();
                    $list->importing = false;
                    $list->save();
                    UserListImported::dispatch(
                        $this->payload->list->id,
                        $this->payload->userId,
                        $this->payload->teamId
                    );
                }
            }
        } catch (\Exception $e) {
            SendSlackNotification::dispatch(
                ('Error in importing contacts. ' . $e->getMessage() . '----' . $e->getFile() . '-----' . $e->getLine())
            );
        }
    }

    public function setSocialColumn($key, $mappedColumns, $row)
    {
        $handler = trim(isset($mappedColumns->$key) ? $row[$mappedColumns->$key] : null);
        if (($handler != '') && isset($this->socialHandlersFromSocialColumn[$key]) && ($handler != $this->socialHandlersFromSocialColumn[$key])) {
            dump('RUNNING IMPORT SOCIAL QUEUE');
            ImportContactFromSocial::dispatch('cyberinspects', 'instagram')->onQueue(
                config('import.instagram_queue')
            );
        }
        if ($handler == '' && isset($this->socialHandlersFromSocialColumn[$key])) {
            $handler = $this->socialHandlersFromSocialColumn[$key];
        }
        return $handler;
    }

    public function loadSocialFromOneColumn($socialColumn)
    {
        $platforms = array(
            'instagram' => '/instagram\.com\/([\w.]+)/',
            'linkedin' => '/linkedin\.com\/in\/([\w.]+)/',
            'twitter' => '/twitter\.com\/([\w.]+)/',
            'snapchat' => '/snapchat\.com\/([\w.]+)/',
            'twitch' => '/twitch\.tv\/([\w.]+)/',
            'youtube' => '/youtube\.com\/(?:channel\/|user\/|c\/)?([\w.]+)/',
            'tiktok' => '/tiktok\.com\/@([\w.]+)/',
            'onlyFans' => '/onlyfans\.com\/([\w.]+)/',
            'wiki' => '/en\.wikipedia\.org\/wiki\/([\w.]+)/',
        );

        $socialHandlers = array();
        $urls = preg_split('/[\s,]+/', $socialColumn);
        foreach ($urls as $url) {
            foreach ($platforms as $platform => $regex) {
                if (preg_match($regex, $url, $matches)) {
                    $socialHandlers[$platform] = $matches[1];
                    break;
                }
            }
        }
        return $socialHandlers;
    }
}
