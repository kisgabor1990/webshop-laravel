<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Property extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'hasList',
    ];

    public function categories() {
        return $this->belongsToMany(Category::class)->withTrashed();
    }

    public function values() {
        return $this->hasMany(Property_value::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
