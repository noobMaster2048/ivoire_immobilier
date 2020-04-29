<?php

namespace App\Http\Controllers;

use App\Client;
use App\Echeancier;
use App\Maison;
use App\Souscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SouscriptionController extends Controller
{

    public function create($id) {
        $client = Client::findOrFail($id);
        return Inertia::render('Souscription/Create',[
            'client' => function() use($client) {
                return $client;
            },
            'maisons' => function() {
                return DB::select('select * from maisons m where NOT exists (select s.maison_id from souscriptions s where s.maison_id = m.id)');
            }
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'date_souscription' => ['required'],
            'apport_initial' => ['required'],
            'solde_initial' => ['required'],
            'client_id' => ['required'],
            'maison_id' => ['required'],
        ]);

        $lignes_echeances = $request->get('option_paiement') / $request->get('ecart_paie');
        $souscription = new Souscription([
            'date_souscription' => $request->get('date_souscription'),
            'apport_initial' => $request->get('apport_initial'),
            'solde_initial' => $request->get('solde_initial'),
            'option_paiement' => $request->get('option_paiement'),
            'ecart_paie' => $request->get('ecart_paie'),
            'date_echeance_1' => $request->get('date_echeance_1'),
            'date_echeance_2' => $request->get('date_echeance_2'),
            'client_id' => $request->get('client_id'),
            'maison_id' => $request->get('maison_id'),
        ]);
        $souscription->save();

        for ($i = 0; $i < $lignes_echeances; $i++) {
            $ligneMois = substr($request->get('date_echeance_1'),5,2) + $i;
            $ligneAnnee = substr($request->get('date_echeance_1'),0,4);

            if ((substr($request->get('date_echeance_1'),5,2) + $i) > 12) {
                $ligneMois = $ligneMois - 12;
                $ligneAnnee = $ligneAnnee +1;
            }
            if ((substr($request->get('date_echeance_1'),5,2) + $i) > 24) {
                $ligneMois = $ligneMois - 12;
                $ligneAnnee = $ligneAnnee +1;
            }
            if ((substr($request->get('date_echeance_1'),5,2) + $i) > 36) {
                $ligneMois = $ligneMois - 12;
                $ligneAnnee = $ligneAnnee +1;
            }
            if ((substr($request->get('date_echeance_1'),5,2) + $i) > 48) {
                $ligneMois = $ligneMois - 12;
                $ligneAnnee = $ligneAnnee +1;
            }
            if ((substr($request->get('date_echeance_1'),5,2) + $i) > 60) {
                $ligneMois = $ligneMois - 12;
                $ligneAnnee = $ligneAnnee +1;
            }
            $echeance = new Echeancier([
                'souscription_id' => $souscription->id,
                'numero_ordre' => $i + 1,
                'montant' => $request->get('solde_initial') / $lignes_echeances,
                'jour' => substr($request->get('date_echeance_1'),8,2),
                'mois' => $ligneMois,
                'annee' => $ligneAnnee,
                'ecart' => $request->get('ecart_paie'),
            ]);
            $echeance->save();
        }
        return Redirect::route('clients')->with('success', 'La souscription a été effectué');
    }

    public function edit($id) {
        $souscription = Souscription::findOrFail($id);
        return Inertia::render('Souscription/Edit',[
            'souscription' => function() use($souscription) {
                return [
                    'id' => $souscription->id,
                    'date_souscription' => $souscription->date_souscription,
                    'apport_initial' => $souscription->apport_initial,
                    'solde_initial' => $souscription->solde_initial,
                    'option_paiement' => $souscription->option_paiement,
                    'ecart_paie' => $souscription->ecart_paie,
                    'date_echeance_1' => $souscription->date_echeance_1,
                    'date_echeance_2' => $souscription->date_echeance_2,
                    'client' => $souscription->client()->first(),
                    'maison' => $souscription->maison()->first(),
                    'echeanciers' => $souscription->echeanciers()->orderBy('numero_ordre')->get(),
                ];
            }
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'date_souscription' => ['required'],
            'apport_initial' => ['required'],
            'solde_initial' => ['required'],
            'client_id' => ['required'],
            'maison_id' => ['required'],
        ]);

        $souscription = Souscription::findOrFail($id);
        $souscription->update([
            'apport_initial' => $request->get('apport_initial'),
            'solde_initial' => $request->get('solde_initial'),
            'option_paiement' => $request->get('option_paiement'),
            'ecart_paie' => $request->get('ecart_paie'),
            'date_echeance_1' => $request->get('date_echeance_1'),
            'date_echeance_2' => $request->get('date_echeance_2'),
        ]);

        $souscription->echeanciers()->delete();

        $lignes_echeances = $request->get('option_paiement') / $request->get('ecart_paie');

        for ($i = 0; $i < $lignes_echeances; $i++) {
            $ligneMois = substr($request->get('date_echeance_1'),5,2) + $i;
            $ligneAnnee = substr($request->get('date_echeance_1'),0,4);

            if ((substr($request->get('date_echeance_1'),5,2) + $i) > 12) {
                $ligneMois = $ligneMois - 12;
                $ligneAnnee = $ligneAnnee +1;
            }
            if ((substr($request->get('date_echeance_1'),5,2) + $i) > 24) {
                $ligneMois = $ligneMois - 12;
                $ligneAnnee = $ligneAnnee +1;
            }
            if ((substr($request->get('date_echeance_1'),5,2) + $i) > 36) {
                $ligneMois = $ligneMois - 12;
                $ligneAnnee = $ligneAnnee +1;
            }
            if ((substr($request->get('date_echeance_1'),5,2) + $i) > 48) {
                $ligneMois = $ligneMois - 12;
                $ligneAnnee = $ligneAnnee +1;
            }
            if ((substr($request->get('date_echeance_1'),5,2) + $i) > 60) {
                $ligneMois = $ligneMois - 12;
                $ligneAnnee = $ligneAnnee +1;
            }

            $echeancier = new Echeancier([
                'souscription_id' => $souscription->id,
                'numero_ordre' => $i + 1,
                'montant' => $request->get('solde_initial') / $lignes_echeances,
                'jour' => substr($request->get('date_echeance_1'),8,2),
                'mois' => $ligneMois,
                'annee' => $ligneAnnee,
            ]);
            $echeancier->save();
        }

        return Redirect::route('clients')->with('success', 'Souscription modifié');
    }
}
