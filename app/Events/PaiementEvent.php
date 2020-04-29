<?php

namespace App\Events;

use App\JournalPaiement;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PaiementEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var JournalPaiement
     */
    public $journal;

    /**
     * Create a new event instance.
     *
     * @param JournalPaiement $journal
     */
    public function __construct(JournalPaiement $journal)
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
