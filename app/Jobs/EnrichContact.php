<?php

namespace App\Jobs;

use App\Events\ContactEnriched;
use App\Events\ContactImported;
use App\Models\Contact;
use App\Models\Creator;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class EnrichContact implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

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
        $this->params['enrich'] = true;
        $this->params['contact_id'] = $contact->id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $enriching = 0;
        $charge = $this->params['charge'];
        $batch = $this->getEnrichContactBatch();
        if ($twitter = $this->contact->getRawOriginal('twitter')) {
            $enriching = true;
            $this->params['charge'] = $charge;
            $batch->add([
                (new ImportFromSocialAndAddTOCrm([$twitter], 'twitter', $this->params))->onQueue(config('import.twitter_queue'))
            ]);
            $charge = false;
        }
        if ($instagram = $this->contact->getRawOriginal('instagram')) {
            $enriching = true;
            $this->params['charge'] = $charge;
            $batch->add([
                (new ImportFromSocialAndAddTOCrm($instagram, 'instagram', $this->params))->onQueue(config('import.instagram_queue'))
            ]);
            $charge = false;
        }
        if ($twitch = $this->contact->getRawOriginal('twitch')) {
            $enriching = true;
            $this->params['charge'] = $charge;
            $batch->add([
                (new ImportFromSocialAndAddTOCrm($twitch, 'twitch', $this->params))->onQueue(config('import.twitch_queue'))
            ]);
            $charge = false;
        }
        if ($tiktok = $this->contact->getRawOriginal('tiktok')) {
            $enriching = true;
            $this->params['charge'] = $charge;
            $batch->add([
                (new ImportFromSocialAndAddTOCrm($tiktok, 'tiktok', $this->params))->onQueue(config('import.tiktok_queue'))
            ]);
        }
        Contact::query()->where('id', $this->contact->id)->update(['enriching' => $enriching]);
    }

    public function getEnrichContactBatch()
    {
        $batch = DB::table('job_batches')
            ->where('cancelled_at', null)
            ->where('finished_at', null)
            ->where('contact_id', $this->contact->id)->first();
        if (is_null($batch)) {
            $batch = Bus::batch([])->then(function (Batch $batch) {
                // All jobs completed successfully...
            })->catch(function (Batch $batch, Throwable $e) {
                // First batch job failure detected...
            })->finally(function (Batch $batch) {
                // The batch has finished executing...
                $batch = DB::table('job_batches')
                    ->where('id', $batch->id)->first();
                if ($batch) {
                    $contact = Contact::query()->where('id', $batch->contact_id)->first();
                    $contact->enriching = false;
                    $contact->save();
                    ContactEnriched::dispatch($contact->id, $contact->team_id);
                }
            })->dispatch();
            DB::table('job_batches')->where('id', $batch->id)->update([
                'contact_id' => $this->contact->id,
            ]);
        } else {
            $batch = Bus::findBatch($batch->id);
        }

        return $batch;
    }
}
