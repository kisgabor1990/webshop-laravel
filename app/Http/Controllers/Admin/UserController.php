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
        $billing_addresses = Billing_address::withTrashed()->get();
        $shipping_addresses = Shipping_address::withTrashed()->get();

        return view('admin.felhasznalok.index')->with([
            'users' => $users,
            'billing_addresses' => $billing_addresses,
            'shipping_addresses' => $shipping_addresses
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


        return view('admin.felhasznalok.mutat')->with([
            'user' => $user,
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
        $user->email = $request->email;
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
    public function delete(User $user)
    {
        $user->delete();

        return redirect()->to('admin/felhasznalok')->withSuccess('A felhasználó törlésre került!');
    }

    /**
     * Restore the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();

        return redirect()->to('admin/felhasznalok')->withSuccess('A felhasználó sikeresen visszaállítva!');
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::withTrashed()->find($id)->forceDelete();

        return redirect()->to('admin/felhasznalok')->withSuccess('A felhasználó végleg törlésre került!');
    }
}
