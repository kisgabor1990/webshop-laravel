<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing_address;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use App\Models\Shipping_address;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        $users = User::withTrashed()->get();
        $billing_addresses = Billing_address::withTrashed()->get();
        $shipping_addresses = Shipping_address::withTrashed()->get();
        $categories = Category::withTrashed()->get();
        $brands = Brand::withTrashed()->get();
        $properties = Property::withTrashed()->get();
        $products = Product::withTrashed()->get();
        $orders = null;

        return view('admin.dashboard')->with([
            'users' => $users,
            'billing_addresses' => $billing_addresses,
            'shipping_addresses' => $shipping_addresses,
            'categories' => $categories,
            'brands' => $brands,
            'properties' => $properties,
            'products' => $products,
        ]);
    }
}
