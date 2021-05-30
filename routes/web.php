<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BillingAddessController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\ProductsController as AdminProductsController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\ShippingAddressController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OpinionController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PasswordRecoveryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SessionsController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
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

Route::redirect('/home', url('/'));

Route::get('/termekek', [ProductsController::class, 'index']);
Route::get('/termek/{product:slug}', [ProductsController::class, 'show']);
Route::get('/termekek/kereses', [ProductsController::class, 'search']);
Route::get('/termekek/{category_slug}/{subcategory_slug?}', [ProductsController::class, 'list']);

Route::get('/impresszum', function() {
    return view('infos.impresszum');
});
Route::get('/aszf', function() {
    return view('infos.aszf');
});
Route::get('/adatkezeles', function() {
    return view('infos.adatkezeles');
});
Route::get('/elallas', function() {
    return view('infos.elallas');
});
Route::get('/panaszkezeles', function() {
    return view('infos.panaszkezeles');
});

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

Route::get('/profil/email-megerosites', function() {
    // return view('auth.email_megerosites');
    return redirect('/')->withErrors('Erősítse meg email címét!');
})->name('verification.notice');

Route::middleware(['auth'])->group(function () {
    Route::get('/kijelentkezes', [SessionsController::class, 'destroy']);
    Route::get('/profil', [SessionsController::class, 'index']);


    Route::get('/profil/email-megerosites/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();
    
        return redirect('/')->withSuccess('Email címe sikeresen megerősítve!');
    })->middleware('signed')->name('verification.verify');

    Route::post('/profil/email-megerosites', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();
    
        return redirect('/')->withSuccess('Az email cím megerősítéséhez szükséges levelet kiküldtük!');
    })->middleware('throttle:6,1')->name('verification.send');

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
    Route::get('/felhasznalok/torol/{user}', [UserController::class, 'delete'] );
    Route::get('/felhasznalok/vegleg-torol/{id}', [UserController::class, 'destroy'] );
    Route::get('/felhasznalok/visszaallit/{id}', [UserController::class, 'restore'] );
    
    Route::get('/kategoriak', [CategoriesController::class, 'index'] );
    Route::get('/kategoriak/mutat/{id}', [CategoriesController::class, 'show'] );
    Route::get('/kategoriak/rendez', [CategoriesController::class, 'order'] );
    Route::post('/kategoriak/rendez', [CategoriesController::class, 'setOrder'] );
    Route::get('/kategoriak/uj', [CategoriesController::class, 'create'] );
    Route::post('/kategoriak/uj', [CategoriesController::class, 'store'] );
    Route::get('/kategoriak/szerkeszt/{id}', [CategoriesController::class, 'edit'] );
    Route::post('/kategoriak/szerkeszt/{id}', [CategoriesController::class, 'update'] );
    Route::get('/kategoriak/torol/{category}', [CategoriesController::class, 'delete'] );
    Route::get('/kategoriak/vegleg-torol/{id}', [CategoriesController::class, 'destroy'] );
    Route::get('/kategoriak/visszaallit/{id}', [CategoriesController::class, 'restore'] );
    
    Route::get('/szamlazasi-cimek', [BillingAddessController::class, 'index'] );
    Route::get('/szamlazasi-cimek/mutat/{id}', [BillingAddessController::class, 'show'] );
    Route::get('/szamlazasi-cimek/uj', [BillingAddessController::class, 'create'] );
    Route::post('/szamlazasi-cimek/uj', [BillingAddessController::class, 'store'] );
    Route::get('/szamlazasi-cimek/szerkeszt/{id}', [BillingAddessController::class, 'edit'] );
    Route::post('/szamlazasi-cimek/szerkeszt/{id}', [BillingAddessController::class, 'update'] );
    Route::get('/szamlazasi-cimek/torol/{billing_address}', [BillingAddessController::class, 'delete'] );
    Route::get('/szamlazasi-cimek/vegleg-torol/{id}', [BillingAddessController::class, 'destroy'] );
    Route::get('/szamlazasi-cimek/visszaallit/{id}', [BillingAddessController::class, 'restore'] );
    
    Route::get('/szallitasi-cimek', [ShippingAddressController::class, 'index'] );
    Route::get('/szallitasi-cimek/mutat/{id}', [ShippingAddressController::class, 'show'] );
    Route::get('/szallitasi-cimek/uj', [ShippingAddressController::class, 'create'] );
    Route::post('/szallitasi-cimek/uj', [ShippingAddressController::class, 'store'] );
    Route::get('/szallitasi-cimek/szerkeszt/{id}', [ShippingAddressController::class, 'edit'] );
    Route::post('/szallitasi-cimek/szerkeszt/{id}', [ShippingAddressController::class, 'update'] );
    Route::get('/szallitasi-cimek/torol/{shipping_address}', [ShippingAddressController::class, 'delete'] );
    Route::get('/szallitasi-cimek/vegleg-torol/{id}', [ShippingAddressController::class, 'destroy'] );
    Route::get('/szallitasi-cimek/visszaallit/{id}', [ShippingAddressController::class, 'restore'] );

    Route::get('/gyartok', [BrandController::class, 'index'] );
    Route::get('/gyartok/mutat/{id}', [BrandController::class, 'show'] );
    Route::get('/gyartok/uj', [BrandController::class, 'create'] );
    Route::post('/gyartok/uj', [BrandController::class, 'store'] );
    Route::get('/gyartok/szerkeszt/{id}', [BrandController::class, 'edit'] );
    Route::post('/gyartok/szerkeszt/{id}', [BrandController::class, 'update'] );
    Route::get('/gyartok/torol/{brand}', [BrandController::class, 'delete'] );
    Route::get('/gyartok/visszaallit/{id}', [BrandController::class, 'restore'] );
    Route::get('/gyartok/vegleg-torol/{id}', [BrandController::class, 'destroy'] );
    
    Route::get('/tulajdonsagok', [PropertyController::class, 'index'] );
    Route::get('/tulajdonsagok/mutat/{id}', [PropertyController::class, 'show'] );
    Route::get('/tulajdonsagok/uj', [PropertyController::class, 'create'] );
    Route::post('/tulajdonsagok/uj', [PropertyController::class, 'store'] );
    Route::get('/tulajdonsagok/szerkeszt/{id}', [PropertyController::class, 'edit'] );
    Route::post('/tulajdonsagok/szerkeszt/{id}', [PropertyController::class, 'update'] );
    Route::get('/tulajdonsagok/torol/{property}', [PropertyController::class, 'delete'] );
    Route::get('/tulajdonsagok/visszaallit/{id}', [PropertyController::class, 'restore'] );
    Route::get('/tulajdonsagok/vegleg-torol/{id}', [PropertyController::class, 'destroy'] );
    
    Route::get('/termekek', [AdminProductsController::class, 'index'] );
    Route::get('/termekek/mutat/{id}', [AdminProductsController::class, 'show'] );
    Route::get('/termekek/uj', [AdminProductsController::class, 'create'] );
    Route::post('/termekek/uj', [AdminProductsController::class, 'store'] );
    Route::get('/termekek/szerkeszt/{id}', [AdminProductsController::class, 'edit'] );
    Route::post('/termekek/szerkeszt/{id}', [AdminProductsController::class, 'update'] );
    Route::get('/termekek/torol/{product}', [AdminProductsController::class, 'delete'] );
    Route::get('/termekek/visszaallit/{id}', [AdminProductsController::class, 'restore'] );
    Route::get('/termekek/vegleg-torol/{id}', [AdminProductsController::class, 'destroy'] );
});



Route::get('{page}', [PagesController::class, 'show']);
