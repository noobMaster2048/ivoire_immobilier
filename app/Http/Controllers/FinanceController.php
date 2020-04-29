<?php

namespace App\Http\Controllers;

use App\Client;
use App\Export\EtatExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class FinanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Finance/Index', [
            'clients' => function() {
            return Client::with(['reglements',
                'souscription',
                'somme_reglements' ,
                'souscription.maison',
                'souscription.echeanciers' => function($query) {
                $query->orderBy('numero_ordre', 'asc');
            }])->has('souscription')->get();
            },
        ]);
    }

    public function etats()
    {
        return Inertia::render('Finance/Etat', [
            'etats' => function() {
                return DB::select("select c.id, c.nom, c.prenom, m.prix_unitaire as prix, s.apport_initial as apport, sum(r.montant) as total, round((sum(r.montant) /s.solde_initial) * 100, 2) as pourcentage,
                                       round((s.apport_initial/m.prix_unitaire) *100, 2) as pourcentage_apport
                                from clients c, souscriptions s, reglements r, maisons m
                                where c.id = s.client_id and c.id = r.client_id and m.id = s.maison_id and m.id = r.maison_id
                                group by c.id, c.nom, c.prenom, m.prix_unitaire, s.apport_initial, s.solde_initial,round((s.apport_initial/m.prix_unitaire) *100, 2)");
            }
        ]);
    }

    public function export_finance()
    {
        return Excel::download(new EtatExport(), 'Etat_financiers.xlsx');
    }
}
