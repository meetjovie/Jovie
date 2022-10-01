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

class UserListDuplicated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $list;
    private $status;
    private $message;
    protected $userId;
    private $teamId;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($list, $userId, $teamId, $status = true, $message)
    {
        $this->list = $list;
        $this->userId = $userId;
        $this->teamId = $teamId;
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('userListDuplicated.'.$this->teamId);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $data = ['status' => $this->status, 'data' => [
            'list' => $this->list->id
        ], 'message' => $this->message];
        if ($this->status === false) {
            UserList::where('id', $this->list->id)->delete();
        }
        return $data;
    }
}
