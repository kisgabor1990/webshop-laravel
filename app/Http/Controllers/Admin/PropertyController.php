<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPropertyRequest;
use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::withTrashed()->orderBy('id')->get();

        return view('admin.tulajdonsagok.index')->with('properties', $properties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tulajdonsagok.uj');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminPropertyRequest $request)
    {
        Property::updateOrCreate([
            'name' => $request->name,
        ]);

        return redirect()->to('admin/tulajdonsagok')->withSuccess('Új tulajdonság sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!Property::withTrashed()->find($id)) {
            return redirect()->to("/admin/tulajdonsagok")->withErrors(['message' => 'Nem létező tulajdonság!']);
        }
        return view('admin.tulajdonsagok.mutat')->with([
            'property' => Property::withTrashed()->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Property::withTrashed()->find($id)) {
            return redirect()->to("/admin/tulajdonsagok")->withErrors(['message' => 'Nem létező tulajdonság!']);
        }

        return view('admin.tulajdonsagok.szerkeszt')->with([
            'property' => Property::withTrashed()->find($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(AdminPropertyRequest $request, $id)
    {
        if (!Property::withTrashed()->find($id)) {
            return redirect()->to("/admin/tulajdonsagok")->withErrors(['message' => 'Nem létező tulajdonság!']);
        }
        $mod_property = Property::withTrashed()->find($id);

        $mod_property->name = $request->name;
        $mod_property->save();

        return redirect()->to('admin/tulajdonsagok')->withSuccess('Tulajdonság sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function delete(Property $property)
    {
        if (!$property) {
            return redirect()->to("/admin/tulajdonsagok")->withErrors(['message' => 'Nem létező tulajdonság!']);
        }

        $property->delete();
        return redirect()->to('admin/tulajdonsagok')->withSuccess('Tulajdonság sikeresen törölve!');
    }

    public function restore($id)
    {
        if (!Property::withTrashed()->find($id)) {
            return redirect()->to("/admin/tulajdonsagok")->withErrors(['message' => 'Nem létező tulajdonság!']);
        }

        Property::withTrashed()->find($id)->restore();
        return redirect()->to('admin/tulajdonsagok')->withSuccess('Tulajdonság sikeresen visszaállítva!');
    }

    public function destroy($id)
    {
        if (!Property::withTrashed()->find($id)) {
            return redirect()->to("/admin/tulajdonsagok")->withErrors(['message' => 'Nem létező tulajdonság!']);
        }

        Property::withTrashed()->find($id)->forceDelete();
        return redirect()->to('admin/tulajdonsagok')->withSuccess('Tulajdonság végleg törölve!');
    }
}
