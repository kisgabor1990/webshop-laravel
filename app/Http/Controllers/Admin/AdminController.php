<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $user_count = User::count();
        $product_count = Product::count();
        $category_count = Category::count();

        return view('admin.dashboard')->with([
            'user_count' => $user_count,
            'product_count' => $product_count,
            'category_count' => $category_count,
        ]);
    }
}
