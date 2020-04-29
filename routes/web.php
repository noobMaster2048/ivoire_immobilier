<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FinanceController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\MaisonController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\ReglementController;
use App\Http\Controllers\SouscriptionController;
use App\Http\Controllers\StatistiqueController;
use App\Http\Controllers\UserController;

Route::get('connexion', [AuthController::class, 'showLogin'])->name('connexion')->middleware('guest');
Route::post('connexion', [AuthController::class, 'postLogin'])->name('connexion')->middleware('guest');
Route::post('deconnexion', [AuthController::class, 'logout'])->name('deconnexion');


Route::get('/', [DashboardController::class, 'index'])->name('acceuil')->middleware('auth');

/**
 * Gestion du programme
*/
Route::get('programmes', [ProgrammeController::class, 'index'])->name('programmes')->middleware('auth');
Route::get('programme/new', [ProgrammeController::class, 'create'])->name('programme.create')->middleware('auth');
Route::post('programme', [ProgrammeController::class, 'store'])->name('programme.store')->middleware('auth');
Route::get('programme/{id}', [ProgrammeController::class, 'edit'])->name('programme.edit')->middleware('auth');
Route::put('programme/{id}', [ProgrammeController::class, 'update'])->name('programme.update')->middleware('auth');
Route::delete('programme/{id}', [ProgrammeController::class, 'destroy'])->name('programme.delete')->middleware('auth');


/**
 * Gestion utilisateur
 */
Route::get('utilisateurs', [UserController::class, 'index'])->name('users')->middleware('auth');
Route::get('utilisateur/new', [UserController::class, 'create'])->name('user.create')->middleware('auth');
Route::post('utilisateur', [UserController::class, 'store'])->name('user.store')->middleware('auth');
Route::get('utilisateur/{id}', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::put('utilisateur/{id}', [UserController::class, 'update'])->name('user.update')->middleware('auth');
Route::delete('utilisateur/{id}', [UserController::class, 'destroy'])->name('user.delete')->middleware('auth');

/**
 * Gestion maison
 */
Route::get('maisons', [MaisonController::class,'index'])->name('maisons')->middleware('auth');
Route::get('maison/new', [MaisonController::class,'create'])->name('maison.create')->middleware('auth');
Route::post('maison', [MaisonController::class,'store'])->name('maison.store')->middleware('auth');
Route::get('maison/{id}', [MaisonController::class,'edit'])->name('maison.edit')->middleware('auth');
Route::put('maison/{id}', [MaisonController::class,'update'])->name('maison.update')->middleware('auth');
Route::delete('maison/{id}', [MaisonController::class,'destroy'])->name('maison.delete')->middleware('auth');


/**
 * Gestion client
 */
Route::get('clients', [ClientController::class,'index'])->name('clients')->middleware('auth');
Route::get('clients/inactif', [ClientController::class,'inactif'])->name('clients.inactif')->middleware('auth');
Route::put('clients/active/{id}', [ClientController::class,'active'])->name('client.active')->middleware('auth');
Route::delete('clients/supprimer/{id}', [ClientController::class,'supprimer'])->name('client.supprimer')->middleware('auth');
Route::get('client/new', [ClientController::class,'create'])->name('client.create')->middleware('auth');
Route::post('client', [ClientController::class,'store'])->name('client.store')->middleware('auth');
Route::get('client/{id}', [ClientController::class,'edit'])->name('client.edit')->middleware('auth');
Route::put('client/{id}', [ClientController::class,'update'])->name('client.update')->middleware('auth');
Route::delete('client/{id}', [ClientController::class,'destroy'])->name('client.delete')->middleware('auth');
Route::get('clients/export', [ClientController::class, 'export'])->name('client.export')->middleware('auth');

/**
 * Gestion des souscriptions
 */
Route::get('souscriptions', [SouscriptionController::class, 'index'])->name('souscriptions')->middleware('auth');
Route::get('souscription/new/{client}', [SouscriptionController::class, 'create'])->name('souscription.create')->middleware('auth');
Route::post('souscription', [SouscriptionController::class, 'store'])->name('souscription.store')->middleware('auth');
Route::get('souscription/{id}/edit', [SouscriptionController::class, 'edit'])->name('souscription.edit')->middleware('auth');
Route::put('souscription/{id}', [SouscriptionController::class, 'update'])->name('souscription.update')->middleware('auth');

/**
 * Gestion des reglements
 */
Route::get('reglement/new/{id}', [ReglementController::class, 'create'])->name('reglement.create')->middleware('auth');
Route::get('reglement/recu', [ReglementController::class, 'recu_index'])->name('recu')->middleware('auth');
Route::post('reglement', [ReglementController::class, 'store'])->name('reglement.store')->middleware('auth');

/**
 * Espace finance
 */
Route::get('finances', [FinanceController::class, 'index'])->name('finances')->middleware('auth');
Route::get('finances/etats', [FinanceController::class, 'etats'])->name('finances.etats')->middleware('auth');
Route::get('finances/export', [FinanceController::class, 'export_finance'])->name('finances.export')->middleware('auth');

/**
 *  route pour les statistiques
 */
Route::get('autre-statistiques', [StatistiqueController::class, 'autreStatistique'])->name('autre.statistique')->middleware('auth');
Route::get('statistique-base', [StatistiqueController::class, 'statistiqueBase'])->name('base.statistique')->middleware('auth');

/*
 * Route pour les contrats
 */
Route::get('contrats', [ContratController::class, 'index'])->name('contrats')->middleware('auth');
Route::get('contrats/index', [ContratController::class, 'contrats'])->name('contrats.index')->middleware('auth');
Route::get('contrats/existant', [ContratController::class, 'contrat_existant'])->name('contrats.existant')->middleware('auth');
Route::get('contrat/new/{id}', [ContratController::class, 'create'])->name('contrat.create')->middleware('auth');
Route::post('/contrat', [ContratController::class, 'store'])->name('contrat.store')->middleware('auth');
Route::get('/contrat/{id}', [ContratController::class, 'edit'])->name('contrat.edit')->middleware('auth');
Route::put('/contrat/{id}', [ContratController::class, 'update'])->name('contrat.update')->middleware('auth');
Route::delete('/contrat/{id}', [ContratController::class, 'destroy'])->name('contrat.delete')->middleware('auth');
Route::get('contrat-pdf', [ContratController::class, 'contrat_pdf'])->name('contrat.pdf');



/**
 * Journal de l'application
 */

Route::get('/journal/logs', [JournalController::class, 'logs'])->name('journal.logs')->middleware('auth');
Route::get('/journal/paiements', [JournalController::class, 'paiement'])->name('journal.paiements')->middleware('auth');
