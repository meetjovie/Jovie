<?php

namespace App\Jobs;

use App\Events\ListEnriched;
use App\Models\Contact;
use App\Models\Creator;
use App\Models\UserList;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Throwable;

class EnrichList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $listId;
    private $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($listId, $params)
    {
        $this->listId = $listId;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $contacts = Contact::getEnrichableContactsFromLists($this->listId);
        $this->params['list_id'] = $this->listId;
        foreach ($contacts as $contact) {
            EnrichContact::dispatch($contact, $this->params);
        }
        UserList::query()->where('id', $this->listId)->update(['updating' => true]);
    }
}
