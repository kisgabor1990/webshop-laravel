<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
    ];

    public function brands() {
        return $this->belongsToMany(Brand::class)->withTrashed();
    }

    public function properties() {
        return $this->belongsToMany(Property::class)->withTrashed();
    }
    
    public function getCategories() {
        return $this::get();
    }
    
    public function getCategoryData($slug) {
        return $this::where('slug', $slug)
                ->first();
    }
}
