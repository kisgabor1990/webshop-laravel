<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category_subcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    public function category() {
        return $this->belongsTo(Category::class)->withTrashed();
    }

    public function products() {
        return $this->hasMany(Product::class, 'subcategory_id')->withTrashed();
    }
}
