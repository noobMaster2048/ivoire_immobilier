<?php

namespace App\Http\Controllers;

use App\Client;
use App\Events\PaiementEvent;
use App\Journal;
use App\JournalPaiement;
use App\Reglement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ReglementController extends Controller
{

    public function create($id)
    {
        $client = Client::findOrFail($id);
        return Inertia::render('Reglement/Create', [
            'client' => function() use($client) {
               return [
                   'id' => $client->id,
                   'nom' => $client->nom,
                   'prenom' => $client->prenom,
                   'tel_principal' => $client->tel_principal,
                   'numero_compte' => $client->numero_compte,
                   'reglements' => $client->reglements()->get(),
                   'souscription' => $client->souscription()->with('maison')->first(),
                   'somme_reglements' => $client->somme_reglements()->first(),
               ];
            },
            'nbr_versement' => function() use($client) {
                return DB::selectOne('select count(r.id) as total from reglements r where r.client_id = :client', ['client' => $client->id]);

            },

        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'client_id' => ['required'],
            'date_reglement' => ['required'],
            'montant' => ['required'],
            'mode_reglement' => ['required'],
        ]);


        $user = Auth::user();
        $reglement = new Reglement([
            'client_id' => $request->get('client_id'),
            'user_id' => $user->id,
            'maison_id' => $request->get('maison_id'),
            'souscription_id' => $request->get('souscription'),
            'date_reglement' => $request->get('date_reglement'),
            'montant' => $request->get('montant'),
            'mode_reglement' => $request->get('mode_reglement'),
            'statut' => 'attente',
            'num_cheque' => $request->get('num_cheque'),
            'date_cheque' => $request->get('date_cheque'),
            'jour' => substr($request->get('date_reglement'), 8,2),
            'mois' => substr($request->get('date_reglement'),5,2),
            'annee' => substr($request->get('date_reglement'),0,4),
        ]);

        $reglement->save();
        $journal = new JournalPaiement([
            'client_id' => $request->get('client_id'),
            'user_id' => $user->id,
            'montant' => $reglement->montant,
            'date_validation' => now(),
            'reglement_id' => $reglement->id,
        ]);
        event(new PaiementEvent($journal));

        return Redirect::route('clients')->with('success', 'Reglement effectué');
    }

    public function edit($id) {
        $reglement = Reglement::findOrFail($id);
        return Inertia::render('Reglement/Edit', [
            'reglement' => $reglement
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'client_id' => ['required'],
            'date_reglement' => ['required'],
            'montant' => ['required'],
            'mode_reglement' => ['required'],
        ]);

        $reglement = Reglement::findOrFail($id);
        $reglement->update([]);
        return Redirect::route('clients')->with('success', 'Reglement modifié');
    }

    public function recu_index()
    {
        return Inertia::render('Reglement/Recu', [
            'attentes' => function() {
                return Reglement::where('statut','=', 'attente')->with('client.souscription.maison')->get();
            },
            'valides' => function() {
                return Reglement::where('statut', '=', 'valide')->with('client.souscription.maison')->get();
            },
            'annules' => function() {
                return Reglement::where('statut', '=', 'annule')->with('client.souscription.maison')->get();
            }
        ]);
    }
}
