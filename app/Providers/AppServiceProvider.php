<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Pagination\Paginator;
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
