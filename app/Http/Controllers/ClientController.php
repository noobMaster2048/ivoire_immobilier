<?php

namespace App\Http\Controllers;

use App\Client;
use App\Events\LogActivity;
use App\Export\ClientExport;
use App\Journal;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class ClientController extends Controller
{
    public function index() {
        return Inertia::render('Client/Index', [
            'clients' => function() {
                return Client::with(['souscription', 'parrain'])->get();
            }
        ]);
    }

    // Liste des clients désactivés
    public function inactif() {
        return Inertia::render('Client/Inactive', [
            'clients' => function() {
                return Client::onlyTrashed()->get();
            }
        ]);
    }
    // activé un client
    public function active($id) {
        $client = Client::onlyTrashed()->findOrFail($id);
        $client->restore();
        return Redirect::route('clients.inactif')->with('success', 'Client activé');
    }

    public function supprimer($id) {
        $client = Client::onlyTrashed()->findOrFail($id);
        $client->forceDelete();
        return Redirect::route('clients.inactif')->with('error', 'Le client a été definitivement supprimé');
    }

    public function create() {
        return Inertia::render('Client/Create', [
            'users' => function() {
                return User::all();
            }
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'nom' => ['required'],
            'cni' => ['required'],
            'lieu_naissance' => ['required'],
            'tel_principal' => ['required'],
        ]);

      $client =  Client::create([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'statut' => 0,
            'cni' => $request->get('cni'),
            'profession' => $request->get('profession'),
            'lieu_naissance' => $request->get('lieu_naissance'),
            'date_naissance' => $request->get('date_naissance'),
            'reseau_principal' => $request->get('reseau_principal'),
            'reseau_secondaire' => $request->get('reseau_secondaire'),
            'tel_principal' => $request->get('tel_principal'),
            'tel_secondaire' => $request->get('tel_secondaire'),
            'email' => $request->get('email'),
            'banque' => $request->get('banque'),
            'numero_compte' => $request->get('numero_compte'),
            'adresse' => $request->get('adresse'),
            'residence' => $request->get('residence'),
            'observations' => $request->get('observations'),
            'parrain' => $request->get('parrain'),

        ]);

        $user = Auth::user();
        $journal = new Journal([
            'libelle' => 'ajout',
            'description' => 'ajout du client ' .$client->nom. ' ' .$client->prenom,
            'objet_id' => $client->id,
            'user_id' => $user->id,
            'objet_type' => 'client',
            'proprietes' => 'client',
            'client_id' => $client->id,
        ]);
        event(new LogActivity($journal));
        return Redirect::route('souscription.create', $client->id)->with('success', 'Le client a été enregistré');
    }

    public function edit($id) {
        $client = Client::findOrFail($id);
        return Inertia::render('Client/Edit', [
            'client' => function() use($client) {
                return $client;
            },
            'users' => function() {
                return User::all();
            }
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'nom' => ['required'],
            'cni' => ['required'],
            'lieu_naissance' => ['required'],
            'tel_principal' => ['required'],
        ]);

        $client = Client::findOrFail($id);
        $client->update([
            'nom' => $request->get('nom'),
            'prenom' => $request->get('prenom'),
            'statut' => $request->get('statut'),
            'cni' => $request->get('cni'),
            'profession' => $request->get('profession'),
            'lieu_naissance' => $request->get('lieu_naissance'),
            'date_naissance' => $request->get('date_naissance'),
            'reseau_principal' => $request->get('reseau_principal'),
            'reseau_secondaire' => $request->get('reseau_secondaire'),
            'tel_principal' => $request->get('tel_principal'),
            'tel_secondaire' => $request->get('tel_secondaire'),
            'email' => $request->get('email'),
            'banque' => $request->get('banque'),
            'numero_compte' => $request->get('numero_compte'),
            'adresse' => $request->get('adresse'),
            'residence' => $request->get('residence'),
            'observations' => $request->get('observations'),
            'parrain' => $request->get('parrain'),
        ]);

        return Redirect::route('clients')->with('success', 'Le client a été modifié');
    }

    public function destroy($id) {
        $client = Client::findOrFail($id);
        $client->delete();
        return Redirect::route('clients')->with('error', 'Le client a été désactivé');
    }

    public function export()
    {
        return Excel::download(new ClientExport, 'clients.xlsx');

    }
}
