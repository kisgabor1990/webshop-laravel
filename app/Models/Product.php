<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Nagy\LaravelRating\Traits\Rate\Rateable;


class Product extends Model {

    use HasFactory, Rateable;
    
    public function getProduct($id) {
        return $this::find($id);
    }

    public function getProducts($category_id) {
        return $this::where('category_id', $category_id)
                        ->paginate(6);
    }
    
    public function getNewest() {
        return $this::limit(8)->orderByDesc('id')->get();
    }
    
    public function getSimilar($product) {
        return $this::limit(4)
                ->inRandomOrder()
                ->where('category_id', $product->category_id)
                ->where('property', $product->property)
                ->get();
    }

    public function getBrands($category_id) {
        return $this::select('brand as name', $this::raw('count(brand) as count'))
                        ->where('category_id', $category_id)
                        ->groupBy('brand')
                        ->get();
    }

    public function getProperties($category_id) {
        return $this::select('property as name')
                        ->where('category_id', $category_id)
                        ->groupBy('property')
                        ->get();
    }
}
