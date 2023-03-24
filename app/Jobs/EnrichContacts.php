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
        $this->getEnrichBatch();

        $enrichingContactIds = [];
        foreach ($this->contacts as $contact) {
            $enriching = 0;
            $charge = true;
            if ($twitter = $contact->getRawOriginal('twitter')) {
                $enriching += 1;
                $charge = false;
            }
            if ($instagram = $contact->getRawOriginal('instagram')) {
                $enriching += 1;
                $charge = false;
            }
            if ($twitch = $contact->getRawOriginal('twitch')) {
                $enriching += 1;
                $charge = false;
            }
            if ($tiktok = $contact->getRawOriginal('tiktok')) {
                $enriching += 1;
            }

            Contact::query()->where('id', $contact->id)->update(['enriching' => $enriching]);

            if ($enriching) {
                $enrichingContactIds[] = $contact->id;
            }
        }
    }

    public function getEnrichBatch($queue = 'dev_instagram')
    {
        $batch = Bus::batch([
        ])->then(function (Batch $batch) {
            Log::info('All jobs completed successfully...');
        })->catch(function (Batch $batch, Throwable $e = null) {
            Log::info('First batch job failure detected...');
        })->finally(function (Batch $batch) {
            Log::info('The batch has finished executing...');
        })->onQueue($queue)->allowFailures()->dispatch();

        return $batch;
    }

}
