<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\UserController;
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

Route::get('/', [PagesController::class, 'index']);

Route::redirect('/home', '/');

Route::get('/termekek', [ProductsController::class, 'index']);
Route::get('/termekek/{id}', [ProductsController::class, 'show'])->whereNumber('id');
Route::get('/termekek/{category}', [ProductsController::class, 'list'])->where('category', '[a-z-]+');


Route::get('/kosar', [CartController::class, 'index']);
Route::get('/kosarba-rakom/{id}', [CartController::class, 'addToCart']);
Route::get('/kosar/{id}/tobb', [CartController::class, 'increase']);
Route::get('/kosar/{id}/kevesebb', [CartController::class, 'decrease']);
Route::get('/kosar/{id}/torles', [CartController::class, 'destroy']);


Route::middleware(['guest'])->group(function () {
    Route::get('/regisztracio', [RegistrationController::class, 'create']);
    Route::post('/regisztracio', [RegistrationController::class, 'store']);
    Route::get('/elfelejtett-jelszo', [PasswordRecoveryController::class, 'create']);
    Route::post('/elfelejtett-jelszo', [PasswordRecoveryController::class, 'store']);
    Route::get('/uj-jelszo/{token}/{email}', [ResetPasswordController::class, 'create']);
    Route::post('/uj-jelszo', [ResetPasswordController::class, 'store']);
    Route::get('/bejelentkezes', [SessionsController::class, 'create'])->name('bejelentkezes');
    Route::post('/bejelentkezes', [SessionsController::class, 'store']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/kijelentkezes', [SessionsController::class, 'destroy']);
    Route::get('/profil', [SessionsController::class, 'index']);

    Route::post('/termekek/{id}/velemeny', [OpinionController::class, 'store']);
    Route::get('/termekek/{id}/velemeny/szerkesztes', [OpinionController::class, 'edit']);
    Route::post('/termekek/{id}/velemeny/modositas', [OpinionController::class, 'update']);
    Route::get('/termekek/{id}/velemeny/torles', [OpinionController::class, 'destroy']);
});

Route::prefix('admin')->middleware(['admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'] );
    Route::redirect('/', 'admin/dashboard');

    Route::get('/felhasznalok', [UserController::class, 'index'] );
    Route::get('/felhasznalok/mutat/{id}', [UserController::class, 'show'] );
    Route::get('/felhasznalok/uj', [UserController::class, 'create'] );
    Route::post('/felhasznalok/uj', [UserController::class, 'store'] );
    Route::get('/felhasznalok/szerkeszt/{id}', [UserController::class, 'edit'] );
    Route::post('/felhasznalok/szerkeszt/{id}', [UserController::class, 'update'] );
    Route::get('/felhasznalok/torol/{id}', [UserController::class, 'destroy'] );
    Route::get('/felhasznalok/visszaallit/{id}', [UserController::class, 'restore'] );
    
    Route::get('/kategoriak', [CategoriesController::class, 'index'] );
    Route::get('/kategoriak/mutat/{id}', [CategoriesController::class, 'show'] );
    Route::get('/kategoriak/uj', [CategoriesController::class, 'create'] );
    Route::post('/kategoriak/uj', [CategoriesController::class, 'store'] );
    Route::get('/kategoriak/szerkeszt/{id}', [CategoriesController::class, 'edit'] );
    Route::post('/kategoriak/szerkeszt/{id}', [CategoriesController::class, 'update'] );
    Route::get('/kategoriak/torol/{id}', [CategoriesController::class, 'destroy'] );
    Route::get('/kategoriak/visszaallit/{id}', [CategoriesController::class, 'restore'] );

});



Route::get('{page}', [PagesController::class, 'show']);
