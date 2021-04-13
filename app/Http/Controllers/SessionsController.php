<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function auth;
use function back;
use function redirect;
use function view;

class SessionsController extends Controller
{
    public function index() {
        return view('auth.profil');
    }
    
    public function create() {
        return view('auth.bejelentkezes');
    }
    
    public function store(LoginRequest $request) {
        if ( ! (Auth::attempt($request->only('email', 'password'))) ) {
            return redirect()->to("/bejelentkezes")->withErrors(['message' => 'Hibás email/jelszó páros!']);
        }
        
        $request->session()->regenerate();
        
        return redirect()->to('/profil');
    }
    
    public function destroy(Request $request) {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        
        return redirect()->to('/');
    }
}
