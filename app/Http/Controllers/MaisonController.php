<?php

namespace App\Http\Controllers;

use App\Maison;
use App\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MaisonController extends Controller
{
    public function index() {
        return Inertia::render('Maison/Index', [
            'maisons' => function() {
                return Maison::with('programme')->get();
            },
            'progs' => function() {
                return Programme::all();
            }
        ]);
    }

    public function create() {
        return Inertia::render('Maison/Create', [
            'progs' => function() {
                return Programme::all();
            }
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'denomination' => ['required'],
            'standing' => ['required'],
            'programme_id' => ['required'],
            'prix_unitaire' => ['required'],
            'superficie' => ['required'],
            'quantite' => ['required'],
        ]);
        $quantite = $request->get('quantite');
        for ($i = 0; $i < $quantite; $i++) {
            Maison::create([
                'denomination' => $request->get('denomination'),
                'standing' => $request->get('standing'),
                'programme_id' => $request->get('programme_id'),
                'prix_unitaire' => $request->get('prix_unitaire'),
                'superficie' => $request->get('superficie'),
            ]);
        }

        return Redirect::route('maisons')->with('success', 'Les données ont été enregistré');
    }

    public function edit($id) {
        $maison = Maison::findOrFail($id);
        return Inertia::render('Maison/Edit', [
            'maison' => function() use($maison) {
                return $maison;
            },
            'progs' => function() {
                return Programme::all();
            }
        ]);
    }

    public function update(Request $request, $id) {
        $request->validate([
            'denomination' => ['required'],
            'standing' => ['required'],
            'programme_id' => ['required'],
            'prix_unitaire' => ['required'],
            'superficie' => ['required'],
        ]);

        $maison = Maison::findOrFail($id);

        $maison->update([
            'denomination' => $request->get('denomination'),
            'standing' => $request->get('standing'),
            'programme_id' => $request->get('programme_id'),
            'prix_unitaire' => $request->get('prix_unitaire'),
            'superficie' => $request->get('superficie'),
        ]);

        return Redirect::route('maisons')->with('success', 'Les données de la maison ont été modifié');
    }

    public function destroy($id) {
        $maison = Maison::findOrFail($id);
        $maison->delete();
        return Redirect::route('maisons')->with('error', 'Les données de la maison ont été supprimé');
    }
}
