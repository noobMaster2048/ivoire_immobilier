<?php

namespace App\Providers;

use App\Events\LogActivity;
use App\Events\PaiementEvent;
use App\Listeners\LogActivityListner;
use App\Listeners\PaiementListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PaiementEvent::class => [
            PaiementListener::class
        ],
        LogActivity::class => [
            LogActivityListner::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
