<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminPropertyRequest;
use App\Models\Category;
use App\Models\Property;
use App\Models\Property_value;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::withTrashed()->orderBy('category_id')->get();

        return view('admin.tulajdonsagok.index')->with('properties', $properties);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tulajdonsagok.uj')->with([
            'categories' => Category::withTrashed()->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminPropertyRequest $request)
    {
        $category = Category::find($request->selected_category);
        $property = Property::updateOrCreate([
            'name' => $request->name,
            'hasList' => $request->add_values ? '1' : '0',
        ]);
        $property->category()->associate($category);
        $property->save();

        if ($request->values) {
            foreach ($request->values as $key => $value) {
                $property->values()->updateOrCreate([
                    'name' => $value,
                ]);
            }
        }

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

        $property = Property::withTrashed()->find($id);
        $property->name = $request->name;
        $property->hasList = $request->add_values ? '1' : '0';
        $property->save();
        if ($request->values) {
            $property->values()->whereNotIn('name', $request->values)->delete();
            foreach ($request->values as $key => $value) {
                $property->values()->updateOrCreate([
                    'name' => $value,
                ]);
            }
        }

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
