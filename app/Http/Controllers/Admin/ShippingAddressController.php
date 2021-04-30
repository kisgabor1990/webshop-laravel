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
        $shipping_addresses = Shipping_address::withTrashed()
        ->leftJoin('users', 'shipping_addresses.user_id', '=', 'users.id')
        ->leftJoin('addresses', 'shipping_addresses.address_id', '=', 'addresses.id')
        ->select('shipping_addresses.*', 'users.name AS user', 'addresses.city', 'addresses.address', 'addresses.address2', 'addresses.zip')
        ->orderBy('shipping_addresses.user_id')
        ->get();

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
        $address = Address::updateOrCreate([
            'city' => $request->city,
            'address' => $request->address,
            'address2' => $request->address2,
            'zip' => $request->zip,
        ]);

        $shipping_address = [
            'user_id' => $request->user_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address_id' => $address->id,
            'comment' => $request->comment,
        ];

        Shipping_address::create($shipping_address);

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('Új szállítási cím sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function show(Shipping_address $shipping_address, $id)
    {
        if (!$shipping_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }
        return view('admin.szallitasi-cimek.mutat')->with([
            'shipping_address' => $shipping_address->withTrashed()
                ->leftJoin('users', 'shipping_addresses.user_id', '=', 'users.id')
                ->leftJoin('addresses', 'shipping_addresses.address_id', '=', 'addresses.id')
                ->select('shipping_addresses.*', 'users.name AS user', 'addresses.city', 'addresses.address', 'addresses.address2', 'addresses.zip')
                ->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function edit(Shipping_address $shipping_address, $id)
    {
        if (!$shipping_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }
        $users = User::get();

        return view('admin.szallitasi-cimek.szerkeszt')->with([
            'shipping_address' => $shipping_address->withTrashed()
                ->leftJoin('addresses', 'shipping_addresses.address_id', '=', 'addresses.id')
                ->select('shipping_addresses.*', 'addresses.city', 'addresses.address', 'addresses.address2', 'addresses.zip')
                ->find($id),
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
    public function update(AdminShippingAddressRequest $request, Shipping_address $shipping_address, $id)
    {
        if (!$shipping_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }
        $address = Address::updateOrCreate([
            'city' => $request->city,
            'address' => $request->address,
            'address2' => $request->address2,
            'zip' => $request->zip,
        ]);

        $mod_shipping_address = $shipping_address->withTrashed()->find($id);
        $mod_shipping_address->user_id = $request->user_id;
        $mod_shipping_address->name = $request->name;
        $mod_shipping_address->phone = $request->phone;
        $mod_shipping_address->address_id = $address->id;
        $mod_shipping_address->comment = $request->comment;

        $mod_shipping_address->save();

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('Szállítási cím sikeresen módosítva!');
    }

    /**
     * Disable the specified resource.
     *
     * @param  \App\Models\Shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function delete(Shipping_address $shipping_address, $id)
    {
        if (!$shipping_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }
        $shipping_address->find($id)->delete();

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('A szállítási cím törlésre került!');
    }

    /**
     * Restore the specified resource.
     *
     * @param  \App\Models\shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function restore(shipping_address $shipping_address, $id)
    {
        if (!$shipping_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }
        $shipping_address->withTrashed()->find($id)->restore();

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('A szállítási cím sikeresen visszaállítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shipping_address  $shipping_address
     * @return \Illuminate\Http\Response
     */
    public function destroy(shipping_address $shipping_address, $id)
    {
        if (!$shipping_address->withTrashed()->find($id)) {
            return redirect()->to("/admin/szallitasi-cimek")->withErrors(['message' => 'Nem létező szállítási cím!']);
        }
        $shipping_address->withTrashed()->find($id)->forceDelete();

        return redirect()->to('admin/szallitasi-cimek')->withSuccess('A szállítási cím végleg törlésre került!');
    }
}
