<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;


class ResetPasswordController extends Controller
{
    public function create($token, $email) {
        return view("auth.uj-jelszo")->with([
            'token' => $token,
            'email' => $email
        ]);
    }

    public function store(ResetPasswordRequest $request) {
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) use ($request) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ]);
    
                $user->save();
    
                event(new PasswordReset($user));
            }
        );
    
        return $status == Password::PASSWORD_RESET
                    ? redirect()->to('/bejelentkezes')->withSuccess("Sikeres jelszóváltoztatás! Most már bejelentkezhet!")
                    : back()->withErrors(['email' => [__($status)]]);
    }
}
