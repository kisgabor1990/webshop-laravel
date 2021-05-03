<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewCategoryRequest;
use App\Models\Brand;
use App\Models\Brand_Category;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withTrashed()->get();
        $brands = Brand::withTrashed()->get();
        $properties = Property::withTrashed()->get();

        return view('admin.kategoriak.index')->with([
            'categories' => $categories,
            'brands' => $brands,
            'properties' => $properties,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::withTrashed()->orderBy('name')->get();
        $properties = Property::withTrashed()->orderBy('name')->get();
        return view('admin.kategoriak.uj')->with([
            'brands' => $brands,
            'properties' => $properties,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminNewCategoryRequest $request)
    {
        $hu = array('/é/', '/É/', '/á/', '/Á/', '/ó/', '/Ó/', '/ö/', '/Ö/', '/ő/', '/Ő/', '/ú/', '/Ú/', '/ű/', '/Ű/', '/ü/', '/Ü/', '/í/', '/Í/', '/ /');
        $en = array('e', 'E', 'a', 'A', 'o', 'O', 'o', 'O', 'o', 'O', 'u', 'U', 'u', 'U', 'u', 'U', 'i', 'I', '-');

        $slug = strtolower(preg_replace($hu, $en, $request->name));

        $category = Category::create([
            'name' => $request->name,
            'slug' => $slug,
        ]);

        $category->brands()->attach($request->brands);
        $category->properties()->attach($request->properties);

        return redirect()->to('admin/kategoriak')->withSuccess('Új kategória sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category, $id)
    {
        $products = new Product();

        return view('admin.kategoriak.mutat')->with([
            'category' => $category->withTrashed()->find($id),
            'products' => $products->getProducts($id, 15),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category, $id)
    {
        $brands = Brand::withTrashed()->orderBy('name')->get();
        $properties = Property::withTrashed()->orderBy('name')->get();

        return view('admin.kategoriak.szerkeszt')->with([
            'category' => $category->withTrashed()->find($id),
            'brands' => $brands,
            'properties' => $properties,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(AdminNewCategoryRequest $request, Category $category, $id)
    {
        $mod_cat = $category->withTrashed()->find($id);

        $hu = array('/é/', '/É/', '/á/', '/Á/', '/ó/', '/Ó/', '/ö/', '/Ö/', '/ő/', '/Ő/', '/ú/', '/Ú/', '/ű/', '/Ű/', '/ü/', '/Ü/', '/í/', '/Í/', '/ /');
        $en = array('e', 'E', 'a', 'A', 'o', 'O', 'o', 'O', 'o', 'O', 'u', 'U', 'u', 'U', 'u', 'U', 'i', 'I', '-');

        $slug = strtolower(preg_replace($hu, $en, $request->name));

        $mod_cat->name = $request->name;
        $mod_cat->slug = $slug;

        $mod_cat->save();

        $mod_cat->brands()->sync($request->brands);
        $mod_cat->properties()->sync($request->properties);

        return redirect()->to('admin/kategoriak')->withSuccess('Kategória sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Category $category, $id)
    {
        $category->find($id)->delete();

        return redirect()->to('admin/kategoriak')->withSuccess('A kategória törlésre került!');
    }

    public function restore(Category $category, $id)
    {
        $category->withTrashed()->find($id)->restore();
        return redirect()->to('admin/kategoriak')->withSuccess('A kategória sikeresen visszaállítva!');
    }

    public function destroy(Category $category, $id)
    {
        $category->withTrashed()->find($id)->forceDelete();

        return redirect()->to('admin/kategoriak')->withSuccess('A kategória végleg törlésre került!');
    }
}
