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
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($list, $status = true, $message)
    {
        $this->list = $list;
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
        return new PrivateChannel('duplicateList.'.$this->list->id);
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        $data = ['status' => $this->status, 'list' => $this->list->id, 'message' => $this->message];
        if ($this->status === false) {
            UserList::where('id', $this->list->id)->delete();
        }
        return $data;
    }
}
