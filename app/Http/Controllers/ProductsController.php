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

    public function list(Category $category)
    {
        if (!$category) {
            return view('pages.404');
        }

        // $filterBrand = $productModel->getBrands($categoryData->id);
        // $filterProperty = $productModel->getProperties($categoryData->id);

        return view('products.list')->with([
            'category' => $category,
            'products' => $category->products()->with(['category', 'subCategory', 'images', 'ratings', 'brand', 'properties'])->paginate(6),
            ]);
            // ->with('filterBrand', $filterBrand)
            // ->with('filterProperty', $filterProperty);
    }

    public function show(Category $category, Category_subcategory $subcategory, Product $product)
    {
        $user = null;
        $opinionModel = new Opinion();
        $myOpinion = null;

        if (!$product) {
            return view('pages.404');
        }
        $similar = Product::where('id', '!=', $product->id)->where('subcategory_id', $product->subCategory->id)->limit(4)->get();

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
