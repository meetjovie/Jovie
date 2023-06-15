<?php

namespace App\Jobs;

use App\Events\UserListImported;
use App\Models\Contact;
use App\Models\Creator;
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

    private $additionalSocialHandlers = [];

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
//                $contact['user_list_id'] = $this->payload->list->id;
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
                    $this->socialHandlersFromSocialColumn = $this->loadSocialsFromText($row[$this->payload->mappedColumns->socials]);
                }

                $contact['instagram'] = $this->setSocialColumn('instagram', $this->payload->mappedColumns, $row);
                if (!empty($contact['instagram']) && $contact['instagram'][0] == '@') {
                    $contact['instagram'] = substr($contact['instagram'], 1);
                }

                $contact['youtube'] = $this->setSocialColumn('youtube', $this->payload->mappedColumns, $row);
                $contact['twitter'] = $this->setSocialColumn('twitter', $this->payload->mappedColumns, $row);
                $contact['twitch'] = $this->setSocialColumn('twitch', $this->payload->mappedColumns, $row);
                $contact['onlyFans'] = $this->setSocialColumn('onlyFans', $this->payload->mappedColumns, $row);
                $contact['tiktok'] = $this->setSocialColumn('tiktok', $this->payload->mappedColumns, $row);
                $contact['linkedin'] = $this->setSocialColumn('linkedin', $this->payload->mappedColumns, $row);
                $contact['snapchat'] = $this->setSocialColumn('snapchat', $this->payload->mappedColumns, $row);
                $contact['wiki'] = $this->setSocialColumn('wiki', $this->payload->mappedColumns, $row);
                if (count($this->additionalSocialHandlers)) {
                    foreach ($this->additionalSocialHandlers as $network => $handlers) {
                        foreach ($handlers as $handler) {
                            // Check if the contact doesn't already have a handler for the network
                            if (empty($contact[$network])) {
                                // Assign the handler to the contact for the network
                                $contact[$network] = $handler;
                                unset($this->additionalSocialHandlers[$network][0]);
                            } else {
                                // Dispatch a job to import the contact from the social network
                                ImportContactFromSocial::dispatch($network, $handler);
                            }
                        }
                    }
                }

                $contact = Contact::saveContact($contact, $this->payload->list)->first();

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
                if ($this->payload->list && count($this->payload->list)) {
                    $lists = UserList::query()->whereIn('id', $this->payload->list)->get();
                    foreach ($lists as $list) {
                        $list->importing = false;
                        $list->save();
                        UserListImported::dispatch(
                            $list->id,
                            $this->payload->userId,
                            $this->payload->teamId
                        );
                    }
                }
            }
        } catch (\Exception $e) {
            Log::info('Error in importing contacts. ' . $e->getMessage() . '----' . $e->getFile() . '-----' . $e->getLine());
//            SendSlackNotification::dispatch(
//                ('Error in importing contacts. ' . $e->getMessage() . '----' . $e->getFile() . '-----' . $e->getLine())
//            );
        }
    }

    public function setSocialColumn($key, $mappedColumns, $row)
    {
        // Trim and check if the key exists in the mapped columns
        $handler = trim(isset($mappedColumns->$key) ? $row[$mappedColumns->$key] : null);

        // Check if the handler contains a URL
        if ($this->containsUrl($handler)) {
            // Load social handlers from the handler text
            $handlers = $this->loadSocialsFromText($handler);
            $handler = $handlers[$key][0] ?? null;
            unset($handlers[$key][0]);

            // Merge additional social handlers with existing ones
            $this->additionalSocialHandlers = array_merge($this->additionalSocialHandlers, $handlers);
        }

        // Check if the handler is not empty, and it's not already in the social handlers from the social column
        if (!empty($handler) && isset($this->socialHandlersFromSocialColumn[$key])
            && !in_array($handler, $this->socialHandlersFromSocialColumn[$key])
            && in_array($key, Creator::IMPORTABLE_SOCIALS)
        ) {
            $this->additionalSocialHandlers[$key][] = $this->socialHandlersFromSocialColumn[$key][0];
        }

        // If the handler is empty, use the first social handler from the social column
        if (empty($handler) && isset($this->socialHandlersFromSocialColumn[$key])) {
            $handler = $this->socialHandlersFromSocialColumn[$key][0];
        }

        return $handler;
    }

    public function loadSocialsFromText($socialColumn)
    {
        // Regular expressions for different social media platforms
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

        // Extract social handlers from URLs
        foreach ($urls as $url) {
            foreach ($platforms as $platform => $regex) {
                if (preg_match($regex, $url, $matches)) {
                    $socialHandlers[$platform][] = $matches[1];
                    break;
                }
            }
        }

        return $socialHandlers;
    }

    public function containsUrl($string)
    {
        // Regular expression to check if the string contains a URL
        $regex = '/\b(?:[\w-]+\.)+[a-z]{2,}\b/i';
        return preg_match($regex, $string) === 1;
    }

}
