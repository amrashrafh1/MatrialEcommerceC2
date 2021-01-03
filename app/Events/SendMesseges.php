<?php

namespace App\Events;

use App\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;

class SendMesseges implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User that sent the message
     *
     * @var \App\User
     */

    /**
     * Message details
     *
     * @var \App\Message
     */
    public $message,$conv_id,$gallery = [];

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Message $message, $conv_id)
    {
        if(!blank($message->gallery)) {
            foreach($message->gallery as $file) {
                array_push($this->gallery, \Storage::url($file->file));
            }
        }
        $this->message   = $message;
        $this->conv_id   = $conv_id;
        $this->dontBroadcastToCurrentUser();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PresenceChannel('chat.'.$this->conv_id);

    }


}
