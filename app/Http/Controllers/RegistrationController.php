<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\Address;
use App\Models\Billing_address;
use App\Models\Shipping_address;
use App\Models\User;
use App\Notifications\Welcome;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use function view;

class RegistrationController extends Controller {

    public function create() {
        return view('auth.regisztracio');
    }

    public function store(RegistrationRequest $request) {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $address = Address::updateOrCreate([
            'city' => $request->billing_city,
            'address' => $request->billing_address,
            'address2' => $request->billing_address2,
            'zip' => $request->billing_zip,
        ]);

        $billing_address = $user->billing_address()->create([
            'choose_company' => $request->choose_company,
            'name' => $request->name,
            'tax_num' => $request->taxnum,
        ]);

        $billing_address->address()->associate($address);

        $billing_address->save();

        $address = Address::updateOrCreate([
            'city' => $request->shipping_city,
            'address' => $request->shipping_address,
            'address2' => $request->shipping_address2,
            'zip' => $request->shipping_zip,
        ]);

        $shipping_address = $user->shipping_address()->create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        $shipping_address->address()->associate($address);

        $shipping_address->save();

        $user->notify(new Welcome());
        Auth::login($user);
        event(new Registered($user));

        return redirect('/')->withSuccess('Sikeres regisztráció! Az email cím megerősítéséhez szükséges levelet kiküldtük!');
    }

}
