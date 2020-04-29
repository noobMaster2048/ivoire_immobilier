<?php

namespace App\Observers;

use App\Journal;
use App\Reglement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;

class ReglementObserver
{
    public function creating(Reglement $reglement)
    {
        $reglementCount = $reglement->count();
        $reglement->reference = 'ref_' .str_pad($reglementCount + 1, 6, "0", STR_PAD_LEFT);

   }
}
