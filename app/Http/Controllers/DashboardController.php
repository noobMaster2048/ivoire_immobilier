<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index() {
        return Inertia::render('Acceuil/Index', [
                'maisons_total' => function() {
                    return DB::table('maisons')->distinct('id')->count();
                },
            'maisons_dispo' => function() {
                return DB::selectOne('select count(m.id) as total from maisons m where not exists (select s.maison_id from souscriptions s where s.maison_id = m.id)');
            },
            'total_clients' => function() {
                return DB::table('clients')->distinct('id')->count();
            },
            'programmes' => function() {
                return DB::table('programmes')->distinct('id')->count();
            },
            'souscriptions' => function() {
                return DB::selectOne('select count(s.id) as total from souscriptions s');
            },
            'montant_maisons' => function() {
                return DB::selectOne('select sum(m.prix_unitaire) as total from maisons m');
            },
            'montant_apport' => function() {
                return DB::selectOne('select sum(s.apport_initial) as total from souscriptions s');
            },
            'mont_maisons_sous' => function() {
                return DB::selectOne('select sum(m.prix_unitaire) as total from maisons m where exists (select s.maison_id from souscriptions s where s.maison_id = m.id)');
            },
            'paiement_attente' => function() {
                return DB::selectOne("select count(r.id) as total from reglements r where r.statut = 'attente'");
            },
            'paiement_valide' => function() {
                return DB::selectOne("select count(r.id) as total from reglements r where r.statut = 'valide'");
            }
        ]);
    }
}
