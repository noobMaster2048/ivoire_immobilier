<?php

namespace App\Events;

use App\Journal;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LogActivity
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Journal
     */
    public $journal;

    /**
     * Create a new event instance.
     *
     * @param Journal $journal
     */
    public function __construct(Journal $journal)
    {
        //
        $this->journal = $journal;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
