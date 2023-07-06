<?php

namespace App\Events;

use App\Models\UserList;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UsersOnCell implements ShouldBroadcast, ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $listId;
    private $teamId;
    private $cell = 2;

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
        return new PresenceChannel('userOnUserlist.' . $this->teamId . '.' . $this->listId . '.' . $this->cell);
    }

}
