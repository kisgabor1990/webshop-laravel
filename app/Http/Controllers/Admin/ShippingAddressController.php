<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminShippingAddressRequest;
use App\Models\Address;
use App\Models\Shipping_address;
use App\Models\User;
use Illuminate\Http\Request;

class ShippingAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shipping_addresses = Shipping_address::withTrashed()->with(['address', 'user'])->orderBy('user_id')->get();

        return view('admin.szallitasi-cimek.index')->with('shipping_addresses', $shipping_addresses);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$shipping_address = Shipping_address::withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }
        return view('admin.szallitasi-cimek.mutat')->with([
            'shipping_address' => $shipping_address
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$shipping_address = Shipping_address::withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }

        return view('admin.szallitasi-cimek.szerkeszt')->with([
            'shipping_address' => $shipping_address,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function update(AdminShippingAddressRequest $request, $id)
    {
        if (!$shipping_address = Shipping_address::withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }

        $address = Address::updateOrCreate([
            'city' => $request->city,
            'address' => $request->address,
            'address2' => $request->address2,
            'zip' => $request->zip,
        ]);

        $shipping_address->name = $request->name;
        $shipping_address->phone = str_starts_with($request->phone, '+36') ? substr($request->phone, 3) : $request->phone;

        $shipping_address->address()->associate($address);

        $shipping_address->save();

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('Szállítási cím sikeresen módosítva!');
    }
}
