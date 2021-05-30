<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        if ($user = User::find(Auth::id())) {
            $user->carts()->updateOrCreate(
                ['product_id' => $product->id],
                ['quantity' => DB::raw('quantity + 1')],
            );
        } else {
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
        }

        return response()->json($product);
    }

    public function increase($id)
    {
        if ($user = User::find(Auth::id())) {
            $cart_db = $user->carts()->where('product_id', $id)->with(['product', 'product.brand', 'product.images'])->first();
            $cart[$id] = [
                'name' => $cart_db->product->name,
                'slug' => $cart_db->product->slug,
                'price' => $cart_db->product->price,
                'image' => $cart_db->product->coverImage()->path,
                'brand' => $cart_db->product->brand->name,
                'quantity' => $cart_db->quantity + 1,
            ];
            $cart_db->quantity++;
            $cart_db->save();
        } else {
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
                session()->put('cart', $cart);
            }
        }

        return response()->json($cart[$id]);
    }

    public function decrease($id)
    {
        if ($user = User::find(Auth::id())) {
            $cart_db = $user->carts()->where('product_id', $id)->with(['product', 'product.brand', 'product.images'])->first();
            $product = [
                'name' => $cart_db->product->name,
                'slug' => $cart_db->product->slug,
                'price' => $cart_db->product->price,
                'image' => $cart_db->product->coverImage()->path,
                'brand' => $cart_db->product->brand->name,
                'quantity' => $cart_db->quantity - 1,
            ];
            if ($cart_db->quantity > 1) {
                $cart_db->quantity--;
                $cart_db->save();
            } else {
                $cart_db->delete();
            }
        } else {
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                $product = $cart[$id];
                $product['quantity']--;
            }

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
        if ($user = User::find(Auth::id())) {
            $cart_db = $user->carts()->where('product_id', $id)->with(['product', 'product.brand', 'product.images'])->first();
            $cart_db->delete();
        } else {
            $cart = session()->get('cart');
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        return response(status: 200);
    }
}
