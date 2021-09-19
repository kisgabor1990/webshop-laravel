<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use function resource_path;
use function view;

class PagesController extends Controller
{

    public function index() {
        $newest = Product::with(['images', 'brand', 'properties', 'ratings'])->whereHas('brand', function ($q) {
            $q->whereNull('deleted_at');
        })->orderByDesc('id')->limit(8)->get();
        return view('pages.home')->with('newest', $newest);
    }

    public function show($page) {

        if ( ! is_file(resource_path() . '/views/pages/' . $page . '.blade.php')) {
            $page = '404';
        }


        return view('pages.' . $page);
    }

}
