<?php

namespace App\Jobs;

use App\Events\UserListImported;
use App\Models\Contact;
use App\Models\Import;
use App\Models\User;
use App\Models\UserList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use League\Csv\Reader;

class ImportContacts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $file;
    private $page;
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

            $usStates = (array) json_decode(file_get_contents('https://gist.githubusercontent.com/mshafrir/2646763/raw/8b0dbb93521f5d6889502305335104218454c2bf/states_hash.json'));

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
                if (isset($this->payload->mappedColumns->country) && $country && in_array(strtolower(trim($row[$this->payload->mappedColumns->country])), array_map('strtolower', $usStates))) {
                    $country = 'United States';
                }

                $contact['team_id'] = $this->payload->teamId;
                $contact['user_id'] = $this->payload->userId;
                $contact['user_list_id'] = $this->payload->list->id;
                if ($this->payload->tags) {
                    $tags = explode(',', $this->payload->tags);
                    $contact['tags'] = json_encode(array_values(array_map('trim', $tags)));
                }
                $contact['first_name'] = isset($this->payload->mappedColumns->firstName) ? $row[$this->payload->mappedColumns->firstName] : null;
                $contact['last_name'] = isset($this->payload->mappedColumns->lastName) ? $row[$this->payload->mappedColumns->lastName] : null;
                $contact['full_name'] = ($contact['first_name'].' '.$contact['last_name']);
                $contact['nickname'] = isset($this->payload->mappedColumns->nickname) ? $row[$this->payload->mappedColumns->nickname] : null;
                $contact['suffix'] = isset($this->payload->mappedColumns->suffix) ? $row[$this->payload->mappedColumns->suffix] : null;
                $contact['company'] = isset($this->payload->mappedColumns->company) ? $row[$this->payload->mappedColumns->company] : null;
                $contact['department'] = isset($this->payload->mappedColumns->department) ? $row[$this->payload->mappedColumns->department] : null;
                $contact['title'] = isset($this->payload->mappedColumns->title) ? $row[$this->payload->mappedColumns->title] : null;
                $contact['phone'] = isset($this->payload->mappedColumns->phone) ? $row[$this->payload->mappedColumns->phone] : null;
                $contact['website'] = isset($this->payload->mappedColumns->website) ? $row[$this->payload->mappedColumns->website] : null;
                $contact['gender'] = isset($this->payload->mappedColumns->gender) ? $row[$this->payload->mappedColumns->gender] : null;
                $contact['emails'] = $emails;
                $contact['city'] = isset($this->payload->mappedColumns->lastName) ? $row[$this->payload->mappedColumns->lastName] : null;
                $contact['country'] = $country;

                $contact['instagram'] = isset($this->payload->mappedColumns->instagram) ? $row[$this->payload->mappedColumns->instagram] : null;
                if (! empty($contact['instagram']) && $contact['instagram'][0] == '@') {
                    $contact['instagram'] = substr($contact['instagram'], 1);
                }

                $contact['youtube'] = isset($this->payload->mappedColumns->youtube) ? $row[$this->payload->mappedColumns->youtube] : null;
                $contact['twitter'] = isset($this->payload->mappedColumns->twitter) ? $row[$this->payload->mappedColumns->twitter] : null;
                $contact['twitch'] = isset($this->payload->mappedColumns->twitch) ? $row[$this->payload->mappedColumns->twitch] : null;
                $contact['onlyFans'] = isset($this->payload->mappedColumns->onlyFans) ? $row[$this->payload->mappedColumns->onlyFans] : null;
                $contact['tiktok'] = isset($this->payload->mappedColumns->tiktok) ? $row[$this->payload->mappedColumns->tiktok] : null;
                $contact['linkedin'] = isset($this->payload->mappedColumns->linkedin) ? $row[$this->payload->mappedColumns->linkedin] : null;
                $contact['snapchat'] = isset($this->payload->mappedColumns->snapchat) ? $row[$this->payload->mappedColumns->snapchat] : null;
                $contact['wiki'] = isset($this->payload->mappedColumns->wiki) ? $row[$this->payload->mappedColumns->wiki] : null;
                $contact = Contact::saveContact($contact)->first();
                $contactIds[] = $contact->id;
            }

            if ($this->payload->list) {
                Contact::addContactsToList($contactIds, $this->payload->list->id, $this->payload->teamId);
            }

            if ($this->page >= ceil($this->payload->totalRecords / Import::PER_PAGE) - 1) {
                if ($this->payload->list) {
                    UserList::query()->where('id', $this->payload->list->id)->update(['updating' => false]);
                    UserListImported::dispatch($this->payload->list->id, $this->payload->userId, $this->payload->teamId);
                }
            }

        } catch (\Exception $e) {
            SendSlackNotification::dispatch(('Error in importing contacts. '.$e->getMessage().'----'.$e->getFile().'-----'.$e->getLine()));
        }
    }
}
