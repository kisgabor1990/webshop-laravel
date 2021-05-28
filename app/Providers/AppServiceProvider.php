<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        $menu = [
            'rolunk' => ['fa-users', 'Rólunk'],
            'garancia' => ['fa-shield-alt', 'Garancia'],
            'rendeles-menete' => ['fa-clipboard-list', 'Rendelés menete'],
            'kapcsolat' => ['fa-address-card', 'Kapcsolat'],
        ];
        
        $categories = Category::orderBy('order')->get();

        View::share([
            'menu' => $menu,
            'categories' => $categories,
        ]);
        
        view()->composer(['index', 'products.kosar'], function ($view) {
            if ($user = User::find(auth()->id())) {
                $cart = [];
                
                foreach ($user->carts()->with(['product', 'product.images', 'product.brand'])->get() as $key => $db_cart) {
                    $cart[$db_cart->product_id] = [
                        'name' => $db_cart->product->name,
                        'slug' => $db_cart->product->slug,
                        'price' => $db_cart->product->price,
                        'image' => $db_cart->product->coverImage()->path,
                        'brand' => $db_cart->product->brand->name,
                        'quantity' => $db_cart->quantity,
                    ];
                }
            } else {
                $cart = session()->get('cart');
            }

            $view->with([
                'cart' => $cart,
            ]);
        });

        Paginator::useBootstrap();

        if(env('APP_DEBUG')) {
            DB::listen(function($query) {
                File::append(
                    storage_path('/logs/query.log'),
                    $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL
               );
            });
        }
    }

}
