<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Models\Creator;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Throwable;

class EnrichContacts implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $contacts;
    private $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contacts, $params)
    {
        $this->contacts = $contacts;
        $this->params = $params;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $columns = ['id', 'team_id'];
        foreach (Creator::NETWORKS as $NETWORK) {
            $columns[$NETWORK] = $NETWORK;
        }
        $contacts = Contact::query()->select($columns)->whereIn('id', $this->contacts)->get();

        foreach ($contacts as $contact) {
            EnrichContact::dispatch($contact, $this->params);
        }
    }
}
