<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminEditUserRequest;
use App\Http\Requests\AdminNewUserRequest;
use App\Models\Billing_address;
use App\Models\Shipping_address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withTrashed()->get();
        $billing_addresses_count = Billing_address::count();
        $shipping_addresses_count = Shipping_address::count();

        return view('admin.felhasznalok.index')->with([
            'users' => $users,
            'billing_addresses_count' => $billing_addresses_count,
            'shipping_addresses_count' => $shipping_addresses_count
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.felhasznalok.uj');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminNewUserRequest $request)
    {
        $user = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        User::create($user);

        return redirect()->to('admin/felhasznalok')->withSuccess('Új felhasználó sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::withTrashed()->find($id);
        $billing_addresses = Billing_address::where('user_id', $id)
            ->leftJoin('addresses', 'billing_addresses.address_id', '=', 'addresses.id')
            ->select('billing_addresses.*', 'addresses.city', 'addresses.address', 'addresses.address2', 'addresses.zip')
            ->get();
        $shipping_addresses = Shipping_address::where('user_id', $id)
            ->leftJoin('addresses', 'shipping_addresses.address_id', '=', 'addresses.id')
            ->select('shipping_addresses.*', 'addresses.city', 'addresses.address', 'addresses.address2', 'addresses.zip')
            ->get();

        return view('admin.felhasznalok.mutat')->with([
            'user' => $user,
            'billing_addresses' => $billing_addresses,
            'shipping_addresses' => $shipping_addresses,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::withTrashed()->find($id);

        return view('admin.felhasznalok.szerkeszt')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminEditUserRequest $request, $id)
    {
        $user = User::withTrashed()->find($id);

        $user->name = $request->name;
        if ($request->email != $user->email) {
            $user->email = $request->email;
        }
        if ($request->password != '') {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->to('admin/felhasznalok')->withSuccess('Felhasználó adatai sikeresen módosítva!');
    }

    /**
     * Disable the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(User $user, $id)
    {
        $user->find($id)->delete();

        return redirect()->to('admin/felhasznalok')->withSuccess('A felhasználó törlésre került!');
    }

    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(User $user, $id)
    {
        $user->withTrashed()->find($id)->restore();

        return redirect()->to('admin/felhasznalok')->withSuccess('A felhasználó sikeresen visszaállítva!');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, $id)
    {
        $user->withTrashed()->find($id)->forceDelete();

        return redirect()->to('admin/felhasznalok')->withSuccess('A felhasználó végleg törlésre került!');
    }
}
