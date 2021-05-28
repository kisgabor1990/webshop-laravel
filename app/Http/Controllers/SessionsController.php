<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function auth;
use function back;
use function redirect;
use function view;

class SessionsController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('auth.profil')->with('user', $user);
    }

    public function create()
    {
        return view('auth.bejelentkezes');
    }

    public function store(LoginRequest $request)
    {
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        if (!(Auth::attempt($request->only('email', 'password')))) {
            return redirect()->to("/bejelentkezes")->withErrors(['message' => 'Hibás email/jelszó páros!']);
        }

        $user = User::where('email', $request->email)->first();

        if ($cart = session()->get('cart')) {
            foreach ($cart as $key => $product) {

                $user->carts()->updateOrCreate(
                    ['product_id' => $key],
                    ['quantity' => DB::raw('quantity + ' . $product['quantity'])]
                );
            }
        }

        $request->session()->regenerate();

        return redirect()->intended();
    }

    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->to('/');
    }
}
