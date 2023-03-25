<?php

namespace App\Events;

use App\Models\UserList;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ListEnriched implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $listId;
    private $teamId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($listId, $teamId)
    {
        $this->listId = $listId;
        $this->teamId = $teamId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('listEnriched.'.$this->teamId);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $userList = UserList::query()->where('id', $this->listId);
        return ['status' => true, 'data' => [
            'list' => $userList,
        ], 'message' => 'List Enriched'];
    }
}
