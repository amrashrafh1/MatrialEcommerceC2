<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\User;
class StatusEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $data =  [];
    public function __construct(User $user,$conv_id, $status = null)
    {
        if($status) {
            $user->chat_status = $status;
            $user->save();
        }

        $this->data = [
            'status'     => $user->chat_status,
            'conv_id'    => intval($conv_id),
            'statusText' => trans('user.'.$user->chat_status),
        ];
        $this->dontBroadcastToCurrentUser();

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('status');
    }
}
