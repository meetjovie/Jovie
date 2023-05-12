<?php

namespace App\Jobs;

use App\Events\ContactImported;
use App\Models\UserList;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DuplicateList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    private $offset;
    private $limit;
    private $newListId;
    private $duplicateListId;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($offset, $limit, $newListId, $duplicateListId)
    {
        $this->offset = $offset;
        $this->limit = $limit - 1;
        $this->newListId = $newListId;
        $this->duplicateListId = $duplicateListId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Schema::disableForeignKeyConstraints();
        $creatorIds = DB::table('creator_user_list')
            ->where('user_list_id', $this->duplicateListId)
            ->offset($this->offset)->limit($this->limit)
            ->pluck('creator_id')->toArray();

        $list = UserList::where('id', $this->newListId)->first();
        $list->creators()->syncWithoutDetaching($creatorIds);
        Schema::enableForeignKeyConstraints();
        foreach ($creatorIds as $creatorId) {
            ContactImported::dispatch($creatorId, $list->user_id, $list->team_id, $list->id);
        }
    }
}
