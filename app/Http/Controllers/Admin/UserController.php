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

        return view('admin.felhasznalok.index')->with('users', $users);
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
        $billing_addresses = Billing_address::where('user_id', $id)->get();
        $shipping_addresses = Shipping_address::where('user_id', $id)->get();

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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->to('admin/felhasznalok')->withSuccess('A felhasználó törlésre került!');
    }
    
    public function restore($id) {
        $user = User::withTrashed()->find($id);
        $user->restore();
        
        return redirect()->to('admin/felhasznalok')->withSuccess('A felhasználó sikeresen visszaállítva!');
    }
}
