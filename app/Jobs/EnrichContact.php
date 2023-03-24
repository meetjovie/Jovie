<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Models\Creator;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EnrichContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $contact;
    private $params;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($contact, $params)
    {
        $this->contact = $contact;
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
        $contact = Contact::query()->select($columns)->where('id', $this->contact)->first();
        $enriching = 0;
        $charge = true;
        if ($instagram = $contact->getRawOriginal('instagram')) {
            $enriching += 1;
            ImportAndAddTOCrm::dispatchSync();
            $charge = false;
        }
        Contact::query()->where('id', $contact->id)->update(['enriching' => $enriching]);
    }
}
