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
    public function index()
    {
        $billing_addresses = Billing_address::withTrashed()->orderBy('user_id')->get();

        return view('admin.szamlazasi-cimek.index')->with('billing_addresses', $billing_addresses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('admin.szamlazasi-cimek.uj')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminBillingAddressRequest $request)
    {
        $user = User::find($request->user_id);

        $address = Address::updateOrCreate([
            'city' => $request->city,
            'address' => $request->address,
            'address2' => $request->address2,
            'zip' => $request->zip,
        ]);

        $billing_address = Billing_address::updateOrCreate([
            'choose_company' => $request->choose_company,
            'name' => $request->name,
            'tax_num' => $request->taxnum,
        ]);

        $billing_address->user()->associate($user);
        $billing_address->address()->associate($address);

        $billing_address->save();

        return redirect()->to('admin/szamlazasi-cimek')->withSuccess('Új számlázási cím sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Billing_address  $billing_address
     * @return \Illuminate\Http\Response
     */
    public function show(Billing_address $billing_address, $id)
    {
        
        if (!$billing_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szamlazasi-cimek")->withErrors(['message' => 'Nem létező számlázási cím!']);
        }
        return view('admin.szamlazasi-cimek.mutat')->with([
            'billing_address' => $billing_address->withTrashed()->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Billing_address  $billing_address
     * @return \Illuminate\Http\Response
     */
    public function edit(Billing_address $billing_address, $id)
    {
        if (!$billing_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szamlazasi-cimek")->withErrors(['message' => 'Nem létező számlázási cím!']);
        }
        $users = User::get();

        return view('admin.szamlazasi-cimek.szerkeszt')->with([
            'billing_address' => $billing_address->withTrashed()->find($id),
            'users' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Billing_address  $billing_address
     * @return \Illuminate\Http\Response
     */
    public function update(AdminBillingAddressRequest $request, Billing_address $billing_address, $id)
    {
        if (!$billing_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szamlazasi-cimek")->withErrors(['message' => 'Nem létező számlázási cím!']);
        }

        $user = User::find($request->user_id);

        $address = Address::updateOrCreate([
            'city' => $request->city,
            'address' => $request->address,
            'address2' => $request->address2,
            'zip' => $request->zip,
        ]);

        $mod_billing_address = $billing_address->withTrashed()->find($id);

        $mod_billing_address->choose_company = $request->choose_company;
        $mod_billing_address->name = $request->name;
        $mod_billing_address->tax_num = $request->taxnum;

        $mod_billing_address->user()->associate($user);
        $mod_billing_address->address()->associate($address);

        $mod_billing_address->save();

        return redirect()->to('admin/szamlazasi-cimek')->withSuccess('Számlázási cím sikeresen módosítva!');
    }

    /**
     * Disable the specified resource.
     *
     * @param  \App\Models\Billing_address  $billing_address
     * @return \Illuminate\Http\Response
     */
    public function delete(Billing_address $billing_address, $id)
    {
        if (!$billing_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szamlazasi-cimek")->withErrors(['message' => 'Nem létező számlázási cím!']);
        }
        $billing_address->find($id)->delete();

        return redirect()->to('admin/szamlazasi-cimek')->withSuccess('A számlázási cím törlésre került!');
    }

    /**
     * Restore the specified resource.
     *
     * @param  \App\Models\Billing_address  $billing_address
     * @return \Illuminate\Http\Response
     */
    public function restore(Billing_address $billing_address, $id)
    {
        if (!$billing_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szamlazasi-cimek")->withErrors(['message' => 'Nem létező számlázási cím!']);
        }
        $billing_address->withTrashed()->find($id)->restore();

        return redirect()->to('admin/szamlazasi-cimek')->withSuccess('A számlázási cím sikeresen visszaállítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billing_address  $billing_address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Billing_address $billing_address, $id)
    {
        if (!$billing_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szamlazasi-cimek")->withErrors(['message' => 'Nem létező számlázási cím!']);
        }
        $billing_address->withTrashed()->find($id)->forceDelete();

        return redirect()->to('admin/szamlazasi-cimek')->withSuccess('A számlázási cím végleg törlésre került!');
    }
}
