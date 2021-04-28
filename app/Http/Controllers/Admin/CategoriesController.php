<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminNewCategoryRequest;
use App\Models\Category;
use App\Models\Product;
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

        return view('admin.kategoriak.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.kategoriak.uj');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdminNewCategoryRequest $request)
    {
        $hu=array('/é/','/É/','/á/','/Á/','/ó/','/Ó/','/ö/','/Ö/','/ő/','/Ő/','/ú/','/Ú/','/ű/','/Ű/','/ü/','/Ü/','/í/','/Í/','/ /');
        $en= array('e','E','a','A','o','O','o','O','o','O','u','U','u','U','u','U','i','I','-'); 
       
        $slug = strtolower(preg_replace($hu,$en,$request->name));

        $category = [
            'name' => $request->name,
            'slug' => $slug,
        ];
        
        Category::create($category);

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
        return view('admin.kategoriak.szerkeszt')->with('category', $category->withTrashed()->find($id));
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

        $hu=array('/é/','/É/','/á/','/Á/','/ó/','/Ó/','/ö/','/Ö/','/ő/','/Ő/','/ú/','/Ú/','/ű/','/Ű/','/ü/','/Ü/','/í/','/Í/','/ /');
        $en= array('e','E','a','A','o','O','o','O','o','O','u','U','u','U','u','U','i','I','-'); 
       
        $slug = strtolower(preg_replace($hu,$en,$request->name));

        $mod_cat->name = $request->name;
        $mod_cat->slug = $slug;

        $mod_cat->save();

        return redirect()->to('admin/kategoriak')->withSuccess('Kategória sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, $id)
    {
        $category->find($id)->delete();

        return redirect()->to('admin/kategoriak')->withSuccess('A kategória törlésre került!');
    }
    
    public function restore(Category $category, $id)
    {
        $category->withTrashed()->find($id)->restore();
        return redirect()->to('admin/kategoriak')->withSuccess('A kategória sikeresen visszaállítva!');
    }
}
