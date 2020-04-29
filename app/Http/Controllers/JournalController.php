<?php

namespace App\Http\Controllers;

use App\Journal;
use App\JournalPaiement;
use Illuminate\Http\Request;
use Inertia\Inertia;

class JournalController extends Controller
{
    public function action()
    {
        return Inertia::render('Journal/Action');
    }

    public function paiement()
    {
        return Inertia::render('Journal/Paiement', [
            'journals' => function() {
                return JournalPaiement::with(['reglement.client', 'user'])->get();
            }
        ]);
    }

    public function logs()
    {
        return Inertia::render('Journal/Log', [
            'logs' => function() {
                return Journal::with(['client', 'user'])->get();
            }
        ]);
    }
}
