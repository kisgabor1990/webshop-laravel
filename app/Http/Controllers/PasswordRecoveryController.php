<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordRecoveryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordRecoveryController extends Controller
{
    public function create()
    {
        return view("auth.elfelejtett-jelszo");
    }

    public function store(PasswordRecoveryRequest $request)
    {
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? redirect()->back()->withSuccess('Az új jelszó beállításához szükséges emailt kiküldtük!')
            : redirect()->back()->withErrors(['email' => __($status)]);
    }
}
