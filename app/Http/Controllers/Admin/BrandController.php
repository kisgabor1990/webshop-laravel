<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::withTrashed()->get();

        return view('admin.gyartok.index')->with('brands', $brands);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gyartok.uj');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminBrandRequest $request)
    {
        $brand = [
            'name' => $request->name,
        ];
        
        Brand::create($brand);

        return redirect()->to('admin/gyartok')->withSuccess('Új gyártó sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand, $id)
    {
        return view('admin.gyartok.mutat')->with('brand', $brand->withTrashed()->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand, $id)
    {
        return view('admin.gyartok.szerkeszt')->with('brand', $brand->withTrashed()->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(AdminBrandRequest $request, Brand $brand, $id)
    {
        $mod_brand = $brand->withTrashed()->find($id);
        $mod_brand->name = $request->name;
        $mod_brand->save();

        return redirect()->to('admin/gyartok')->withSuccess('gyártó sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function delete(Brand $brand, $id)
    {
        $brand->find($id)->delete();

        return redirect()->to('admin/gyartok')->withSuccess('A gyártó törlésre került!');
    }

    public function restore(Brand $brand, $id)
    {
        $brand->withTrashed()->find($id)->restore();
        return redirect()->to('admin/gyartok')->withSuccess('A gyártó sikeresen visszaállítva!');
    }

    public function destroy(Brand $brand, $id)
    {
        $brand->withTrashed()->find($id)->forceDelete();

        return redirect()->to('admin/gyartok')->withSuccess('A gyártó végleg törlésre került!');
    }
}
