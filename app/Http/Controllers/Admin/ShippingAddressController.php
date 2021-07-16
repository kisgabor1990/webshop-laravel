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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('admin.szallitasi-cimek.uj')->with('users', $users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminShippingAddressRequest $request)
    {
        $user = User::find($request->user_id);

        $address = Address::updateOrCreate([
            'city' => $request->city,
            'address' => $request->address,
            'address2' => $request->address2,
            'zip' => $request->zip,
        ]);

        $shipping_address = Shipping_address::updateOrCreate([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        $shipping_address->user()->associate($user);
        $shipping_address->address()->associate($address);

        $shipping_address->save();

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('Új szállítási cím sikeresen létrehozva!');
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
        $users = User::get();

        return view('admin.szallitasi-cimek.szerkeszt')->with([
            'shipping_address' => $shipping_address,
            'users' => $users,
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

        $user = User::find($request->user_id);

        $address = Address::updateOrCreate([
            'city' => $request->city,
            'address' => $request->address,
            'address2' => $request->address2,
            'zip' => $request->zip,
        ]);

        $shipping_address->name = $request->name;
        $shipping_address->phone = $request->phone;

        $shipping_address->user()->associate($user);
        $shipping_address->address()->associate($address);

        $shipping_address->save();

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('Szállítási cím sikeresen módosítva!');
    }

    /**
     * Disable the specified resource.
     *
     * @param  \App\Models\Shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function delete(Shipping_address $shipping_address)
    {
        if (!$shipping_address) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }
        $shipping_address->delete();

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('A szállítási cím törlésre került!');
    }

    /**
     * Restore the specified resource.
     *
     * @param  \App\Models\shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (!$shipping_address = Shipping_address::withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }
        $shipping_address->restore();

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('A szállítási cím sikeresen visszaállítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$shipping_address = Shipping_address::withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }
        $shipping_address->forceDelete();

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('A szállítási cím végleg törlésre került!');
    }
}
