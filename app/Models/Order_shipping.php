<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function address() {
        return $this->belongsTo(Address::class);
    }
}
