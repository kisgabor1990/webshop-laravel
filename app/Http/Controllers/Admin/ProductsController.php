<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Property;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::withTrashed()->get();

        return view('admin.termekek.index')->with([
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::withTrashed()->get();

        return view('admin.termekek.uj_kategoria_valasztas')->with([
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->selected_category) {
            $category = Category::withTrashed()->find($request->selected_category);
            return view('admin.termekek.uj')->with('category', $category);
        }

        $category = Category::withTrashed()->find($request->category_id);
        $brand = Brand::withTrashed()->find($request->brand_id);

        $product = Product::updateOrCreate([
            'model' => $request->model,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        $product->properties()->sync($request->properties);
        $product->category()->associate($category);
        $product->brand()->associate($brand);
        $product->save();

        return redirect()->to('admin/termekek')->withSuccess('Új termék sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $id)
    {
        return view('admin.termekek.mutat')->with('product', $product->find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product, $id)
    {
        return view('admin.termekek.szerkeszt')->with('product', $product->find($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $id)
    {
        $brand = Brand::withTrashed()->find($request->brand_id);

        $mod_product = $product->find($id);

        $mod_product->model = $request->model;
        $mod_product->description = $request->description;
        $mod_product->price = $request->price;

        $mod_product->properties()->sync($request->properties);
        $mod_product->brand()->associate($brand);
        $mod_product->save();

        return redirect()->to('admin/termekek')->withSuccess('A termék sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product, $id)
    {
        if (!$product->withTrashed()->find($id)) {
            return redirect()->to("/admin/termekek")->withErrors(['message' => 'Nem létező termék!']);
        }
        $product->find($id)->delete();

        return redirect()->to('admin/termekek')->withSuccess('A termék törlésre került!');
    }

    /**
     * Restore the specified resource.
     *
     * @param  \App\Models\Billing_address  $billing_address
     * @return \Illuminate\Http\Response
     */
    public function restore(Product $product, $id)
    {
        if (!$product->withTrashed()->find($id)) {
            return redirect()->to("/admin/termekek")->withErrors(['message' => 'Nem létező termék!']);
        }
        $product->withTrashed()->find($id)->restore();

        return redirect()->to('admin/termekek')->withSuccess('A termék sikeresen visszaállítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Billing_address  $billing_address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $id)
    {
        if (!$product->withTrashed()->find($id)) {
            return redirect()->to("/admin/termekek")->withErrors(['message' => 'Nem létező termék!']);
        }
        $product->withTrashed()->find($id)->forceDelete();

        return redirect()->to('admin/termekek')->withSuccess('A termék végleg törlésre került!');
    }
}
