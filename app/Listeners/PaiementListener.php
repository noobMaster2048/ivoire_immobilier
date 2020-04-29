<?php

namespace App\Listeners;

use App\Events\PaiementEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PaiementListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param PaiementEvent $event
     * @return void
     */
    public function handle(PaiementEvent $event)
    {
        $event->journal->save();
    }
}
