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

    public function addToCart($id)
    {
        $productModel = new Product();

        if (!($product = $productModel->getProduct($id))) {
            return view('pages.404');
        }

        $product_name = $product->brand . " " . $product->property . " " . $product->type;
        $cart = session()->get('cart');

        if (!$cart) {
            $cart = [
                $id => [
                    'name' => $product_name,
                    'quantity' => 1,
                    'price' => $product->price
                ]
            ];
        } else if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product_name,
                'quantity' => 1,
                'price' => $product->price
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->withSuccess('A termék sikeresen hozzá lett adva a kosárhoz!');
    }

    public function increase($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }
    public function decrease($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);
        }

        return redirect()->back();
    }

    public function destroy($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }
}
