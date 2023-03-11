<?php

namespace App\Events;

use App\Models\Contact;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ContactImported implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $contactId;
    private $teamId;
    private $listId;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($contactId, $teamId, $listId)
    {
        $this->contactId = $contactId;
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
        $contact = Contact::getContacts(['id' => $this->contactId, 'team_id' => $this->teamId])->first();
        $contact = base64_encode(json_encode($contact));
        return ['status' => true, 'data' => [
            'contact' => $contact,
            'list' => $this->listId,
        ], 'message' => $this->listId ? null : 'Contact Imported'];
    }
}
