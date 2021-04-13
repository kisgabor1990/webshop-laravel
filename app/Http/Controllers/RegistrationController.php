<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use function view;

class RegistrationController extends Controller {

    public function create() {
        return view('auth.regisztracio');
    }

    public function store(RegistrationRequest $request) {
        
        $user = [
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'choose_company' => $request->choose_company,
            'phone' => '+36' . $request->phone,
            'billing_name' => $request->billing_name,
            'billing_taxnum' => ($request->choose_company == 'is_company' ? $request->billing_taxnum : ''),
            'billing_city' => $request->billing_city,
            'billing_address' => $request->billing_address,
            'billing_zip' => $request->billing_zip,
            'shipping_same' => $request->shipping_same,
            'shipping_name' => ($request->shipping_same ? $request->billing_name : $request->shipping_name),
            'shipping_city' => ($request->shipping_same ? $request->billing_city : $request->shipping_city),
            'shipping_address' => ($request->shipping_same ? $request->billing_address : $request->shipping_address),
            'shipping_zip' => ($request->shipping_same ? $request->billing_zip : $request->shipping_zip),
        ];
        
        User::create($user);

        return redirect()->back()->withSuccess('Sikeres regisztráció!');
    }

}
