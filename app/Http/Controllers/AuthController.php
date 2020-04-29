<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Inertia\Inertia;

class AuthController extends Controller
{
    public function showLogin() {
        return Inertia::render('Auth/Login');
    }

    public function postLogin(Request $request) {
        $request->validate([
            'login' => ['required'],
            'password' => ['required'],
        ]);
        $credentials = $request->only(['login', 'password']);
        $auth = Auth::attempt($credentials);
        if ($auth) {
            return Redirect::route('acceuil');
        }
        return Redirect::route('connexion')->with('error', 'Oups erreur lors de la connexion. veuillez rentrer les bons identifiants');
    }

    public function logout() {
        Session::flush();
        Auth::logout();
        return Redirect::route('connexion');
    }
}
