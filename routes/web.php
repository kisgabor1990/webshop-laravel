<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SessionsController;
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

Route::get('/', [PagesController::class, 'index'] );

Route::redirect('/home', '/');

Route::get('/termekek', [ProductsController::class, 'index'] );
Route::get('/termekek/{id}', [ProductsController::class, 'show'] )->whereNumber('id');
Route::get('/termekek/{category}', [ProductsController::class, 'list'] )->where('category', '[a-z-]+');

Route::post('/termekek/{id}/velemeny', [OpinionController::class, 'store'] );
Route::get('/termekek/{id}/velemeny/szerkesztes', [OpinionController::class, 'edit'] )
    ->middleware(['auth']);
Route::post('/termekek/{id}/velemeny/modositas', [OpinionController::class, 'update'] );
Route::get('/termekek/{id}/velemeny/torles', [OpinionController::class, 'destroy'] )
->middleware(['auth']);

Route::get('/kosar', [CartController::class, 'index'] );
Route::get('/kosarba-rakom/{id}', [CartController::class, 'addToCart'] );
Route::get('/kosar/{id}/tobb', [CartController::class, 'increase'] );
Route::get('/kosar/{id}/kevesebb', [CartController::class, 'decrease'] );
Route::get('/kosar/{id}/torles', [CartController::class, 'destroy'] );

// ------------------- //
// Felhasználó kezelés //
// ------------------- //

Route::get('/regisztracio', [RegistrationController::class, 'create'] )
->middleware(['guest']);
Route::post('/regisztracio', [RegistrationController::class, 'store'] );

Route::get('/elfelejtett-jelszo', [PasswordRecoveryController::class, 'create'] )
->middleware(['guest']);
Route::post('/elfelejtett-jelszo', [PasswordRecoveryController::class, 'store'] );

Route::get('/uj-jelszo/{token}/{email}', [ResetPasswordController::class, 'create'] )
->middleware(['guest']);
Route::post('/uj-jelszo', [ResetPasswordController::class, 'store'] );

Route::get('/bejelentkezes', [SessionsController::class, 'create'] )
->middleware(['guest'])
->name('bejelentkezes');
Route::post('/bejelentkezes', [SessionsController::class, 'store'] );
Route::get('/kijelentkezes', [SessionsController::class, 'destroy'] );

Route::get('/profil', [SessionsController::class, 'index'] )
->middleware(['auth']);
// ------------------------ //
// Felhasználó kezelés vége //
// ------------------------ //


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


Route::get('{page}', [PagesController::class, 'show'] );