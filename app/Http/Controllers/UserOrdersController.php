<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserOrdersController extends Controller
{
    public function index() {
        $user = Auth::user();

        return view('auth.rendelesek')->with('user', $user);
    }
}
