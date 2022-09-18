<?php

namespace App\Events;

use App\Models\Creator;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreatorImported implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $creatorId;
    private $userId;
    private $teamId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($creatorId, $userId, $teamId)
    {
        $this->creatorId = $creatorId;
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
        return new PrivateChannel('creatorImported.'.$this->teamId);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $creator = Creator::getCrmCreators(['id' => $this->creatorId], $this->userId)->first();
        return ['status' => true, 'data' => $creator, 'message' => 'Creator Imported'];
    }
}
