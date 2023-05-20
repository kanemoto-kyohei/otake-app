<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Appoint;

class AppointCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $appoint;
    public $carender_link;

    /**
     * Create a new event instance.
     */
    public function __construct(Appoint $appoint)
    {
        //イベント発生のタイミングでデータベースを受け取りリスナーに渡す
        $this->appoint = $appoint;
        $this->carender_link = $appoint->carender_link;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }
}
