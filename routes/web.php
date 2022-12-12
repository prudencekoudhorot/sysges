<?php

use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\EntreesProduitsController;
use App\Http\Controllers\InventairesController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\SortiesProduitsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;

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

/*
Route::get('/', function () {
    return view('dashboard');
});
*/

Route::get('/', [CustomAuthController::class, 'dashboard'])->name('dashboard');
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
//Route::get('registration', [CustomAuthController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');
//CRUD module produit
Route::resource('produit', ProduitsController::class);
//CRUD module entrée produit
Route::resource('entree', EntreesProduitsController::class);
//CRUD module sortie produit
Route::resource('sortie', SortiesProduitsController::class);
//CRUD module sortie produit
Route::resource('inventaire', InventairesController::class);
//CRUD module users
Route::resource('user', UsersController::class);
//vue d'export en pdf des entrées
Route::any('entree/export/pdf', [EntreesProduitsController::class, 'trie'])->name('entree.trie');
//traitement export pdf des entrées
Route::any('entree/traiement/pdf', [EntreesProduitsController::class, 'exportpdf'])->name('entree.export');
//vue d'export en pdf des sorties
Route::any('sortie/export/pdf', [SortiesProduitsController::class, 'trie'])->name('sortie.trie');
//traitement export pdf des sorties
Route::any('sortie/traiement/pdf', [SortiesProduitsController::class, 'exportpdf'])->name('sortie.export');
//vue d'export en pdf des inventaires
Route::any('inventaire/export/pdf', [InventairesController::class, 'trie'])->name('inventaire.trie');
//traitement export pdf des inventaires
Route::any('inventaire/traiement/pdf', [InventairesController::class, 'exportpdf'])->name('inventaire.export');
//traitement export pdf des produits
Route::any('produit/traiement/pdf', [ProduitsController::class, 'exportpdf'])->name('produit.export');
//traitement export pdf reste produit
Route::any('reste/traiement/pdf', [CustomAuthController::class, 'exportpdf'])->name('reste.export');
