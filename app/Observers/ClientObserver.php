<?php

namespace App\Observers;

use App\Client;

class ClientObserver
{
    public function creating(Client $client)
    {
        $clientCount = $client->count();
        $client->identifiant = 'client'.str_pad($clientCount + 1, 6, "0", STR_PAD_LEFT);
    }
}
