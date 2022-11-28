<?php

namespace App\Jobs;

use App\Events\ImportListCreated;
use App\Models\Creator;
use App\Models\UserList;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DefaultCrm implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $userId;
    private $teamId;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId, $teamId)
    {
        $this->userId = $userId;
        $this->teamId = $teamId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $list = UserList::firstOrCreateList($this->userId, 'Welcome to Jovie', $this->teamId, '👋');
        $handlers = [
            'timwhite',
            'therock',
            'taylorswift',
            'cristiano',
            'charlidamelio',
            'mkbhd',
            'ninja',
        ];
        $creators = Creator::query()->whereIn('instagram_handler', $handlers)->select('id')->get();
        foreach ($creators as $creator) {
            Creator::addToListAndCrm($creator, $list->id, $this->userId, $this->teamId);
        }
        if ($list->wasRecentlyCreated) {
            ImportListCreated::dispatch($this->teamId, $list);
        }
    }
}
