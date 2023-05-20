<?php

namespace App\Events;

use App\Models\Import;
use App\Models\UserList;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserListImported implements ShouldBroadcast, ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $listId;
    private $userId;
    private $teamId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($listId, $userId, $teamId)
    {
        $this->listId = $listId;
        $this->userId = $userId;
        $this->teamId = $teamId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('userListImported.'.$this->teamId);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $list = UserList::where('id', $this->listId)->first();
        $list->importing = false;
        $list->save();
        if ($list) {
            return ['status' => true, 'data' => [
                'list' => $this->listId,
                'remaining' => UserList::query()->where('importing', 1)->count()
            ], 'message' => "$list->name imported"];
        }
    }
}
