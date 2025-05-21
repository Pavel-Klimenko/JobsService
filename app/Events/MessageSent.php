<?php

namespace App\Events;

use App\Domains\Chat\Models\Message;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user;
    public $message;

    /**
     * Create a new event instance.
     */
    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }


    public function broadcastOn()
    {
//        return [
//            new PrivateChannel('chat'),
//        ];

        return new Channel('chat');
    }

    public function broadcastAs()
    {
        return 'message-sent';
    }

    public function broadcastWith(): array
    {
        return [
            'user_id' => $this->user->id,
            'message' => $this->message,
        ];
    }
}
