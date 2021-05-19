<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Nagy\LaravelRating\Traits\Rate\Rateable;


class Product extends Model {

    use HasFactory, Rateable, SoftDeletes;

    protected $fillable = [
        'model',
        'name',
        'slug',
        'description',
        'price',
    ];

    public function category() {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function subCategory() {
        return $this->belongsTo(Category_subcategory::class, 'subcategory_id');
    }
    
    public function brand() {
        return $this->belongsTo(Brand::class)->withTrashed();
    }

    public function properties() {
        return $this->belongsToMany(Property::class)->withPivot('value')->withTrashed();
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function coverImage() {
        return $this->images->where('isCover', 1)->first();
    }

    public function getProduct($id) {
        return $this::find($id);
    }

    public function getProducts($category_id, $ipp = 6) {
        return $this::where('category_id', $category_id)
                        ->paginate($ipp);
    }
    
    public function getNewest() {
        return $this::limit(8)->with(['images', 'ratings', 'category'])->orderByDesc('id')->get();
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
