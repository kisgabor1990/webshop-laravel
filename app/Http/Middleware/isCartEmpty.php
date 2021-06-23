<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class isCartEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cart = [];
        if (Auth::check()) {
            $cart = Auth::user()->carts;
            if ($cart->isEmpty()) {
                $cart = [];
            }
        } else {
            $cart = session()->get('cart');
        }
        if (empty($cart)) {
            return redirect('/');
        }
        
        return $next($request);
    }
}
