<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    
    public function getCategories() {
        return $this::get();
    }
    
    public function getCategoryData($slug) {
        return $this::where('slug', $slug)
                ->first();
    }
}
