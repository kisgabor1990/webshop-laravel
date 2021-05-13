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
use Illuminate\Support\Str;


class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withTrashed()->orderBy('order')->get();
        $brands = Brand::withTrashed()->get();
        $properties = Property::withTrashed()->get();

        return view('admin.kategoriak.index')->with([
            'categories' => $categories,
            'brands' => $brands,
            'properties' => $properties,
        ]);
    }

    public function order() {
        $categories = Category::withTrashed()->orderBy('order')->get();

        if (count($categories) < 2) {
            return redirect()->to("/admin/kategoriak")->withErrors(['message' => 'Túl kevés kategória a rendezéshez!']);
        }

        return view('admin.kategoriak.rendez')->with([
            'categories' => $categories,
        ]);
    }

    public function setOrder(Request $request) {
        $categories = Category::withTrashed()->get();
        if (count($categories) != count($request->categories)) {
            return redirect()->to("/admin/kategoriak")->withErrors(['message' => 'Hiba történt! Próbálja újra!']);
        }
        
        foreach ($request->categories as $key => $category) {
            if (!$mod_category = $categories->where('name', $category)->first()) {
                return redirect()->to("/admin/kategoriak")->withErrors(['message' => 'Hiba történt! Próbálja újra!']);
            }
            $update_order[] = [
                'id' => $mod_category->id,
                'name' => $mod_category->name,
                'slug' => $mod_category->slug,
                'order' => $key + 1,
            ];
        }
        Category::upsert($update_order, ['id'], ['order']);

        return redirect()->to('admin/kategoriak')->withSuccess('Kategória sorrend sikeresen módosítva!');
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

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::of($request->name)->slug('-'),
            'order' => Category::withTrashed()->count() + 1,
        ]);

        $category->brands()->attach($request->brands);

        return redirect()->to('admin/kategoriak')->withSuccess('Új kategória sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$category = Category::withTrashed()->with(['products.brand', 'products.properties'])->find($id)) {
            return redirect()->to("/admin/kategoriak")->withErrors(['message' => 'Nem létező kategória!']);
        }
        $products = new Product();

        return view('admin.kategoriak.mutat')->with([
            'category' => $category,
            // 'products' => $products->getProducts($id, 15),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$category = Category::withTrashed()->find($id)) {
            return redirect()->to("/admin/kategoriak")->withErrors(['message' => 'Nem létező kategória!']);
        }
        $brands = Brand::withTrashed()->orderBy('name')->get();

        return view('admin.kategoriak.szerkeszt')->with([
            'category' => $category,
            'brands' => $brands,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(AdminNewCategoryRequest $request, $id)
    {
        if (!$category = Category::withTrashed()->find($id)) {
            return redirect()->to("/admin/kategoriak")->withErrors(['message' => 'Nem létező kategória!']);
        }

        $category->name = $request->name;
        $category->slug = Str::of($request->name)->slug('-');
        
        $category->save();

        $category->brands()->sync($request->brands);

        return redirect()->to('admin/kategoriak')->withSuccess('Kategória sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function delete(Category $category)
    {
        if (! $category) {
            return redirect()->to("/admin/kategoriak")->withErrors(['message' => 'Nem létező kategória!']);
        }
        $category->delete();

        return redirect()->to('admin/kategoriak')->withSuccess('A kategória törlésre került!');
    }

    public function restore($id)
    {
        if (!$category = Category::withTrashed()->find($id)) {
            return redirect()->to("/admin/kategoriak")->withErrors(['message' => 'Nem létező kategória!']);
        }
        $category->restore();
        return redirect()->to('admin/kategoriak')->withSuccess('A kategória sikeresen visszaállítva!');
    }

    public function destroy($id)
    {
        if (!$category = Category::withTrashed()->find($id)) {
            return redirect()->to("/admin/kategoriak")->withErrors(['message' => 'Nem létező kategória!']);
        }
        $category->forceDelete();

        return redirect()->to('admin/kategoriak')->withSuccess('A kategória végleg törlésre került!');
    }
}
