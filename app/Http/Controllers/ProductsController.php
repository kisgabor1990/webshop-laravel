<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Category_subcategory;
use App\Models\Opinion;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function Symfony\Component\String\b;
use function view;

class ProductsController extends Controller
{

    public function index()
    {
        $model = new Category();
        $categories = $model->getCategories();

        return view('products.categories')
            ->with('categories', $categories);
    }

    public function list(Request $request, $category_slug, $subcategory_slug = null)
    {
        $category = Category::where('slug', $category_slug)->with(['properties.values', 'brands.products', 'properties.products.brand'])->first();
        if (!empty($subcategory_slug)) {
            $subcategory = Category_subcategory::where('slug', $subcategory_slug)->with(['category.properties.values', 'category.properties.products.brand', 'category.brands.products'])->first();
            $model = $subcategory;
        } else {
            $model = $category;
        }

        $products = $model->products()->with(['category', 'subCategory', 'images', 'ratings', 'brand', 'properties.values'])
            ->whereHas('brand', function ($q) {
                $q->whereNull('deleted_at');
            })->orderBy('id')->getQuery();

        if ($request->brand) {
            $products->whereHas('brand', function ($q) use ($request) {
                $q->whereNull('deleted_at');
                $q->whereIn('name', $request->brand);
            });
        }
        if ($request->properties) {
            foreach ($request->properties as $key => $property) {
                $products->whereHas('properties', function ($q) use ($key, $property) {
                    $q->where('property_id', $key)
                        ->whereIn('value', $property);
                });
            }
        }
        if ($request->price) {
            $products->whereBetween('price', [$request->price['min'], $request->price['max']]);
        }

        $request->flash();
        return view('products.list')->with([
            'category' => $model,
            'products' => $products->paginate(6),
        ]);
    }

    public function show(string $product_slug)
    {
        $user = null;
        $opinionModel = new Opinion();
        $myOpinion = null;

        if (!$product = Product::where('slug', $product_slug)->first()) {
            return view('pages.404');
        }

        $similar = Product::where('id', '!=', $product->id)
            ->whereHas('brand', function ($q) {
                $q->whereNull('deleted_at');
            })
            ->where(function ($query) use ($product) {
                $query->where('subcategory_id', $product->subCategory?->id)
                    ->orWhere('category_id', $product->category->id);
            })->inRandomOrder()->limit(4)->get();

        if (Auth::check()) {
            $user  = User::find(auth()->user()->id);
            $myOpinion = $opinionModel->getOpinion($product->id, $user->id);
        }

        $opinions = $opinionModel->getOpinions($product->id);

        return view('products.show')->with([
            'product' => $product,
            'similar' => $similar,
            'user' => $user,
            'opinions' => $opinions,
            'myOpinion' => $myOpinion
        ]);
    }
}
