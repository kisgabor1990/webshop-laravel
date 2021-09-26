<?php

namespace App\Http\Controllers;

use App\Http\Requests\DataModificationRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataModificationController extends Controller
{
    public function index() {
        $user = Auth::user();

        return view('auth.profil')->with('user', $user);
    }

    public function store(DataModificationRequest $request) {
        $user = Auth::user();

        $address = Address::updateOrCreate([
            'city'     => $request->billing_city,
            'address'  => $request->billing_address,
            'address2' => $request->billing_address2,
            'zip'      => $request->billing_zip,
        ]);

        $user->billing_address->choose_company = $request->choose_company;
        $user->billing_address->name = $request->billing_name;
        $user->billing_address->tax_num = $request->taxnum;

        $user->billing_address->address()->associate($address);

        $user->billing_address->save();

        $address = Address::updateOrCreate([
            'city'     => $request->shipping_city,
            'address'  => $request->shipping_address,
            'address2' => $request->shipping_address2,
            'zip'      => $request->shipping_zip,
        ]);

        $user->shipping_address->name = $request->shipping_name;
        $user->shipping_address->phone = $request->phone;

        $user->shipping_address->address()->associate($address);

        $user->shipping_address->save();

        return redirect()->back()->withSuccess("Az adatok módosítása sikeres!");
    }
}
