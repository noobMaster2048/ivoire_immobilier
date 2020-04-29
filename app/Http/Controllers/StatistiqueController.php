<?php

namespace App\Http\Controllers;

use App\Client;
use App\Maison;
use App\Reglement;
use App\Souscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class StatistiqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function autreStatistique()
    {
        return Inertia::render('Statistique/StatisticAutre', [
            'clients' => function() {
                return Client::all();
            },
            'maisons' => function() {
                return Maison::with('programme')->get();
            },
            'souscriptions' => function() {
                return Souscription::with(['maison', 'client'])->get();
            },
            'reglements' => function() {
                return Reglement::with(['client', 'maison'])->get();
            },
            'nbClients' => function() {
                return DB::table('clients')->distinct()->count();
            },
            'nbMaisonsDispo' => function() {
                return DB::selectOne('select count(id) as nb from maisons m where NOT exists (select s.maison_id from souscriptions s where s.maison_id = m.id)');
            }
         ]);
    }

    public function statistiqueBase()
    {
        return Inertia::render('Statistique/Base', [
            'envois' => function() {
                return DB::select('select u.id, u.nom, count(c.id) as effectif from clients c, users u where c.parrain = u.id group by u.id, u.nom');
            },
            'profession' => function() {
                return DB::select('select count(c.id) as effectif, c.profession from clients c, users u where u.id = c.parrain group by c.profession');
            },
            'reglements' => function() {
                return DB::select('select r.mode_reglement as label, count(r.id) as total from reglements r group by r.mode_reglement');
            },
            'options' => function() {
                return DB::select('select count(s.id) as total, s.option_paiement as label from souscriptions s group by s.option_paiement');
            },
            'ecarts' => function() {
                return DB::select('select count(s.id) as total, s.ecart_paie as label from souscriptions s group by s.ecart_paie');
            },
            'standing' => function() {
                return DB::select('select count(m.id) as total, m.standing as label from maisons m group by m.standing');
            },
            'residences' => function() {
                return DB::select('select count(c.id) as total, c.residence as label from clients c group by c.residence');
            },
            'principal' => function() {
                return DB::select('select count(c.id) as total, c.reseau_principal as label from clients c group by c.reseau_principal');
            },
            'secondaire' => function() {
                return DB::select('select count(c.id) as total, c.reseau_secondaire as label from clients c where c.reseau_secondaire is not null group by c.reseau_secondaire');
            }

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
