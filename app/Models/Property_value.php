<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property_value extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function property() {
        return $this->belongsTo(Property::class)->withTrashed();
    }

    public function products() {
        return $this->belongsToMany(Product::class);
    }
}
