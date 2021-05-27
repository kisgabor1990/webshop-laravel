<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        return view('products.kosar');
    }

    public function addToCart($slug)
    {
        

        if (!($product = Product::where('slug', $slug)->first())) {
            return view('pages.404');
        }

        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $product->id => [
                    'name' => $product->name,
                    'quantity' => 1,
                    'price' => $product->price,
                    'image' => $product->coverImage()->path,
                    'slug' => $product->slug,
                    'brand' => $product->brand->name,
                ]
            ];
        } else if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                'name' => $product->name,
                'quantity' => 1,
                'price' => $product->price,
                'image' => $product->coverImage()->path,
                'slug' => $product->slug,
                'brand' => $product->brand->name,
            ];
        }

        session()->put('cart', $cart);

        return response()->json($product);
    }

    public function increase($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }

        return response()->json($cart[$id]);
    }
    public function decrease($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $product = $cart[$id];
            $product['quantity']--;
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return response()->json($product);
    }

    public function destroy($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return response(status: 200);
    }
}
