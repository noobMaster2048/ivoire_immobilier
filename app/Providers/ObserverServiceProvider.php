<?php

namespace App\Providers;

use App\Client;
use App\Observers\ClientObserver;
use App\Observers\ReglementObserver;
use App\Reglement;
use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Client::observe(ClientObserver::class);
        Reglement::observe(ReglementObserver::class);
    }
}
