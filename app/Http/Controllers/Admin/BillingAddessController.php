<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBillingAddressRequest;
use App\Models\Address;
use App\Models\Billing_address;
use App\Models\User;
use Illuminate\Http\Request;

class BillingAddessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $billing_addresses = Billing_address::withTrashed()->with(['address', 'user'])->orderBy('user_id')->get();

        return view('admin.szamlazasi-cimek.index')->with('billing_addresses', $billing_addresses);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Billing_address $billing_address
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if ( ! $billing_address = Billing_address::withTrashed()->find($id)) {
            return redirect()->to("/admin/szamlazasi-cimek")->withErrors(['message' => 'Nem létező számlázási cím!']);
        }
        return view('admin.szamlazasi-cimek.mutat')->with([
            'billing_address' => $billing_address,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Billing_address $billing_address
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if ( ! $billing_address = Billing_address::withTrashed()->find($id)) {
            return redirect()->to("/admin/szamlazasi-cimek")->withErrors(['message' => 'Nem létező számlázási cím!']);
        }

        return view('admin.szamlazasi-cimek.szerkeszt')->with([
            'billing_address' => $billing_address,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Billing_address $billing_address
     * @return \Illuminate\Http\Response
     */
    public function update(AdminBillingAddressRequest $request, $id) {
        if ( ! $billing_address = Billing_address::withTrashed()->find($id)) {
            return redirect()->to("/admin/szamlazasi-cimek")->withErrors(['message' => 'Nem létező számlázási cím!']);
        }

        $address = Address::updateOrCreate([
            'city'     => $request->city,
            'address'  => $request->address,
            'address2' => $request->address2,
            'zip'      => $request->zip,
        ]);

        $billing_address->choose_company = $request->choose_company;
        $billing_address->name           = $request->name;
        $billing_address->tax_num        = $request->taxnum;

        $billing_address->address()->associate($address);

        $billing_address->save();

        return redirect()->to('admin/szamlazasi-cimek')->withSuccess('Számlázási cím sikeresen módosítva!');
    }
}
