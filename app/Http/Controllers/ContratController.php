<?php

namespace App\Http\Controllers;

use App\Client;
use App\Contrat;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ContratController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        return Inertia::render('Contrat/Index');
    }

    public function contrats()
    {
        return Inertia::render('Contrat/ContratClient', [
            'clients' => function() {
                return DB::select('select c.id, c.nom, c.prenom, m.prix_unitaire, s.solde_initial,sum(r.montant) as montant_total, round((sum(r.montant) / s.solde_initial) * 100, 2) as pourcentage
                                            from clients c, souscriptions s, maisons m, reglements r
                                            where c.id = s.client_id and m.id = s.maison_id and c.id = r.client_id and not exists(select 1 from contrats ct where ct.client_id = c.id)
                                            group by c.id, c.nom, c.prenom, m.prix_unitaire, s.solde_initial');


            }
        ]);
    }

    public function contrat_existant()
    {
        return Inertia::render('Contrat/ContratExistant', [
            'contrats' => function() {
                return Contrat::with(['client'])->get();
            }
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $id
     * @return \Inertia\Response
     */
    public function create($id)
    {
        $client = Client::findOrFail($id);
        return Inertia::render('Contrat/Create', [
            'client' => function() use($client) {
                return [
                    'id' => $client->id,
                    'nom' => $client->nom,
                    'prenom' => $client->prenom,
                    'profession' => $client->profession,
                    'residence' => $client->residence,
                    'date_naissance' => $client->date_naissance,
                    'lieu_naissance' => $client->lieu_naissance,
                    'cni' => $client->cni,
                    'tel_principal' => $client->tel_principal,
                    'souscription' => $client->souscription()->with('maison.programme')->first(),
                ];
            }
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'client_id' => ['required'],
                'maison_id' => ['required'],
                'programme_id' => ['required'],
            ]
        );
        Contrat::create([
            'client_id' => $request->get('client_id'),
            'maison_id' => $request->get('maison_id'),
            'programme_id' => $request->get('programme_id'),
            'epoux' => $request->get('epoux'),
            'ayant' => $request->get('ayant'),
            'date_naissance' => $request->get('date_naissance'),
            'surface_utile' => $request->get('surface_utile'),
            'salon' => $request->get('salon'),
            'terrasse' => $request->get('terrasse'),
            'salle_manger' => $request->get('salle_manger'),
            'nb_chambre' => $request->get('nb_chambre'),
        ]);
       return Redirect::route('contrats.index')->with('success', 'Contrat généré avec succès');
    }

    public function contrat_pdf(PDF $PDF)
    {
        $pdf = $PDF->loadView('pdf.contrat');
       return $pdf->download('contrat.pdf');
   }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $contrat = Contrat::findOrFail($id);
        return Inertia::render('Contrat/Edit', [
            'contrat' => function() use($contrat) {
                return $contrat->with(['client.souscription.maison', 'programme', 'maison.programme'])->first();
            }
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $contrat = Contrat::findOrFail($id);

        $request->validate(
            [
                'client_id' => ['required'],
                'maison_id' => ['required'],
                'programme_id' => ['required'],
            ]
        );
        $contrat->update([
            'client_id' => $request->get('client_id'),
            'maison_id' => $request->get('maison_id'),
            'programme_id' => $request->get('programme_id'),
            'epoux' => $request->get('epoux'),
            'ayant' => $request->get('ayant'),
            'date_naissance' => $request->get('date_naissance'),
            'surface_utile' => $request->get('surface_utile'),
            'salon' => $request->get('salon'),
            'terrasse' => $request->get('terrasse'),
            'salle_manger' => $request->get('salle_manger'),
            'nb_chambre' => $request->get('nb_chambre'),
        ]);
        return Redirect::route('contrats.existant')->with('success', 'Contrat modifié');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contrat = Contrat::findOrFail($id);
        $contrat->delete();
        return Redirect::route('contrats.existant')->with('error', 'Le contrat a été supprimé');
    }
}
