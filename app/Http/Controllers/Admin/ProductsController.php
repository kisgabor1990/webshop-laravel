<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Category_subcategory;
use App\Models\Image;
use App\Models\Product;
use App\Models\Property;
use App\Models\Property_value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $products = Product::withTrashed()->with(['brand', 'category', 'subCategory'])->get();

        return view('admin.termekek.index')->with([
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        if ( ! count($categories = Category::withTrashed()->get())) {
            return redirect()->to('admin/termekek')->withErrors('Még nincs egy kategória sem!');
        }

        return view('admin.termekek.uj_kategoria_valasztas')->with([
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        if ($request->selected_category) {
            $category = Category::withTrashed()->with(['properties.values'])->find($request->selected_category);
            return view('admin.termekek.uj')->with('category', $category);
        }

        $category    = Category::withTrashed()->find($request->category_id);
        $brand       = Brand::withTrashed()->find($request->brand_id);
        $subcategory = Category_subcategory::find($request->subcategory_id);

        $product_name = $brand->name . ' ' . $request->model . ' ' . ($subcategory->name ?? $category->name);

        $product = Product::updateOrCreate([
            'model'       => $request->model,
            'name'        => $product_name,
            'slug'        => Str::of($product_name)->slug('-'),
            'description' => $request->description,
            'price'       => $request->price,
        ]);

        $images_path = 'images/products/' . $product->id;
        if ( ! Storage::exists($images_path)) {
            Storage::makeDirectory($images_path);
        }
        if ($request->hasFile('cover_image')) {
            $cover_image = $request->file('cover_image');
            $path        = $cover_image->store($images_path, 'public');

            $product->images()->updateOrCreate([
                'path'     => '/storage/' . $path,
                'realpath' => $path,
                'isCover'  => 1,
            ]);
        }
        if ($request->hasFile('images')) {
            $images = $request->file('images');

            foreach ($images as $key => $image) {
                $path = $image->store($images_path, 'public');

                $product->images()->updateOrCreate([
                    'path'     => '/storage/' . $path,
                    'realpath' => $path,
                    'isCover'  => 0,
                ]);
            }
        }


        $product->properties()->sync($request->values);
        $product->category()->associate($category);
        $product->subCategory()->associate($subcategory);
        $product->brand()->associate($brand);
        $product->save();

        return redirect()->to('admin/termekek')->withSuccess('Új termék sikeresen létrehozva!');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        if ( ! $product = Product::withTrashed()->with(['category', 'brand'])->find($id)) {
            return redirect()->to("/admin/termekek")->withErrors(['message' => 'Nem létező termék!']);
        }

        return view('admin.termekek.mutat')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        if ( ! $product = Product::withTrashed()->with(['category.properties.values'])->find($id)) {
            return redirect()->to("/admin/termekek")->withErrors(['message' => 'Nem létező termék!']);
        }
        return view('admin.termekek.szerkeszt')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        if ( ! $product = Product::withTrashed()->with(['properties'])->find($id)) {
            return redirect()->to("/admin/termekek")->withErrors(['message' => 'Nem létező termék!']);
        }

        $brand       = Brand::withTrashed()->find($request->brand_id);
        $category    = Category::withTrashed()->find($request->category_id);
        $subcategory = Category_subcategory::find($request->subcategory_id);

        $product_name = $brand->name . ' ' . $request->model . ' ' . ($subcategory->name ?? $category->name);

        $product->model       = $request->model;
        $product->name        = $product_name;
        $product->slug        = Str::of($product_name)->slug('-');
        $product->description = $request->description;
        $product->price       = $request->price;
        $images_path          = 'images/products/' . $product->id;

        if ($request->cover_image && ($product->coverImage()->id != $request->cover_image)) {
            $product->images()->where('id', $product->coverImage()->id)->update([
                'isCover' => 0,
            ]);
            $product->images()->where('id', $request->cover_image)->update([
                'isCover' => 1,
            ]);
        }

        if ($request->images) {
            $delete_images = $product->images()->whereNotIn('id', $request->images)->get();
            if ($delete_images->isNotEmpty()) {
                foreach ($delete_images as $key => $image) {
                    Storage::disk('public')->delete($image->realpath);
                    $image->delete();
                }
            }
        }

        if ( ! Storage::exists($images_path)) {
            Storage::makeDirectory($images_path);
        }

        if ($request->hasFile('new_images')) {
            $images = $request->file('new_images');

            foreach ($images as $key => $image) {
                $path = $image->store($images_path, 'public');

                $product->images()->updateOrCreate([
                    'path'     => '/storage/' . $path,
                    'realpath' => $path,
                    'isCover'  => 0,
                ]);
            }
        }

        $product->properties()->sync($request->values);
        $product->brand()->associate($brand);
        $product->subCategory()->associate($subcategory);
        $product->save();

        return redirect()->to('admin/termekek')->withSuccess('A termék sikeresen módosítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function delete(Product $product) {
        if ( ! $product) {
            return redirect()->to("/admin/termekek")->withErrors(['message' => 'Nem létező termék!']);
        }
        $product->delete();

        return redirect()->to('admin/termekek')->withSuccess('A termék törlésre került!');
    }

    /**
     * Restore the specified resource.
     *
     * @param \App\Models\Billing_address $billing_address
     * @return \Illuminate\Http\Response
     */
    public function restore($id) {
        if ( ! $product = Product::withTrashed()->find($id)) {
            return redirect()->to("/admin/termekek")->withErrors(['message' => 'Nem létező termék!']);
        }
        $product->restore();

        return redirect()->to('admin/termekek')->withSuccess('A termék sikeresen visszaállítva!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Billing_address $billing_address
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        if ( ! $product = Product::withTrashed()->find($id)) {
            return redirect()->to("/admin/termekek")->withErrors(['message' => 'Nem létező termék!']);
        }
        $product->forceDelete();
        Storage::disk('public')->deleteDirectory('images/products/' . $product->id);

        return redirect()->to('admin/termekek')->withSuccess('A termék végleg törlésre került!');
    }
}
