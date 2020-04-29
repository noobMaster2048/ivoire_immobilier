<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class UserController extends Controller
{
    public function index() {
        return Inertia::render('User/Index', [
            'users' => function() {
                $users = User::all();
                return $users;
            }
        ]);
    }

    public function create()
    {
        return Inertia::render('User/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'login' => ['required', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', ' string'],
        ]);

        User::create([
            'email' => $request->get('email'),
            'nom' => $request->get('nom'),
            'login' => $request->get('login'),
            'password' => Hash::make($request->get('password')),
        ]);

        return Redirect::route('users')->with('success', 'Les données ont été enregistré');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return Inertia::render('User/Edit', [
            'user' => function() use($user) {
                return $user;
            }
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'login' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'email' => $request->get('email'),
            'nom' => $request->get('nom'),
            'password' => Hash::make($request->get('password')),
        ]);

        return Redirect::route('users')->with('success', 'Les données ont été enregistré');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return Redirect::route('users')->with('error', 'Utilisateur supprimé');
    }
}
