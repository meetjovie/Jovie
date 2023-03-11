<?php

namespace App\Events;

use App\Models\Creator;
use App\Models\Import;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ContactImported implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $creatorId;
    private $userId;
    private $teamId;
    private $listId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($creatorId, $userId, $teamId, $listId)
    {
        $this->creatorId = $creatorId;
        $this->userId = $userId;
        $this->teamId = $teamId;
        $this->listId = $listId;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('contactImported.'.$this->teamId);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $creator = Creator::getCrmCreators(['id' => $this->creatorId], $this->userId)->first();
        $creator = base64_encode(json_encode($creator));
        return ['status' => true, 'data' => [
            'creator' => $creator,
            'list' => $this->listId,
        ], 'message' => $this->listId ? null : 'Contact Imported'];
    }
}
