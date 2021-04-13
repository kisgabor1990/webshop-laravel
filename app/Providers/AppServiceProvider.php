<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
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

        $categories = Category::get();

        View::share([
            'menu' => $menu,
            'categories' => $categories,
        ]);

        Paginator::useBootstrap();
    }

}
