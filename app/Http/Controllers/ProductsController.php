<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use function view;

class ProductsController extends Controller {

    public function index() {
        $model = new Category();
        $categories = $model->getCategories();

        return view('products.categories')
                        ->with('categories', $categories);
    }

    public function list($category) {
        $categoryModel = new Category();
        $productModel = new Product();

        if (!($categoryData = $categoryModel->getCategoryData($category))) {
            return view('pages.404');
        }

        $products = $productModel->getProducts($categoryData->id);
        $filterBrand = $productModel->getBrands($categoryData->id);
        $filterProperty = $productModel->getProperties($categoryData->id);

        return view('products.list')
                        ->with('products', $products)
                        ->with('category_name', $categoryData->name)
                        ->with('filterBrand', $filterBrand)
                        ->with('filterProperty', $filterProperty);
    }

    public function show($id) {
        $model = new Product();
        if (!($product = $model->getProduct($id))) {
            return view('pages.404');
        }
        $similar = $model->getSimilar($product);
        return view('products.show')->with('product', $product)
                        ->with('similar', $similar);
    }

}
