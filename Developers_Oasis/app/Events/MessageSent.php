<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $newmessage;

    public function __construct(Message $newmessage)
    {
        $this->newmessage = $newmessage;
    }


    public function broadcastOn()
    {
        return new PrivateChannel('messages.'.$this->newmessage->recipient_id);
    }

    public function broadcastWith(){
        return ["message" => $this->newmessage];
    }

}
