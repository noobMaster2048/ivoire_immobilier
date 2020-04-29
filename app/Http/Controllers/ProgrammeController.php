<?php

namespace App\Http\Controllers;

use App\Programme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class ProgrammeController extends Controller
{
    public function index() {
        return Inertia::render('Programme/Index', [
            'programmes' => function() {
                $prog = Programme::all();
                return $prog;
            }
        ]);
    }

    public function create()
    {
        return Inertia::render('Programme/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'structure' => ['required'],
            'libelle' => ['required'],
        ]);

        Programme::create([
            'code' => $request->get('code'),
            'structure' => $request->get('structure'),
            'libelle' => $request->get('libelle'),
            'description' => $request->get('description'),
        ]);

        return Redirect::route('programmes')->with('success', 'Les données ont été enregistré');
    }

    public function edit($id)
    {
        $prog = Programme::findOrFail($id);
        return Inertia::render('Programme/Edit', [
            'programme' => function() use($prog) {
                return $prog;
            }
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'code' => ['required'],
            'structure' => ['required'],
            'libelle' => ['required'],
        ]);

        $prog = Programme::findOrFail($id);
        $prog->update([
            'structure' => $request->get('structure'),
            'libelle' => $request->get('libelle'),
            'description' => $request->get('description'),
        ]);

        return Redirect::route('programmes')->with('success', 'Les données ont été enregistré');
    }

    public function destroy($id)
    {
        $prog = Programme::findOrFail($id);
        $prog->delete();
        return Redirect::route('programmes')->with('error', 'Le programme a été supprimé');
    }
}
