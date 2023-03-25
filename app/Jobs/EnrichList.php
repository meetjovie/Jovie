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

        $batch = $this->getEnrichContactListBatch();
        foreach ($contacts as $contact) {
            $batch->add([
                new EnrichContact($contact, $this->params)
            ]);
        }
        UserList::query()->whereIn('id', $this->listId)->update(['updating' => true]);
    }

    public function getEnrichContactListBatch()
    {
        $batch = DB::table('job_batches')
            ->where('cancelled_at', null)
            ->where('finished_at', null)
            ->where('user_list_id', $this->listId)->first();
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
                    $userList = UserList::query()->where('id', $batch->user_list_id)->first();
                    $userList->updating = false;
                    $userList->save();
                    ListEnriched::dispatch($userList->id, $userList->team_id);
                }
            })->dispatch();
            DB::table('job_batches')->where('id', $batch->id)->update([
                'user_list_id' => $this->listId,
            ]);
        } else {
            $batch = Bus::findBatch($batch->id);
        }

        return $batch;
    }

}
