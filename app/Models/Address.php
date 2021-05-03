<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'city',
        'address',
        'address2',
        'zip',
    ];

    public function billing_addresses() {
        return $this->hasMany(Billing_address::class);
    }

    public function shipping_addresses() {
        return $this->hasMany(Shipping_address::class);
    }
    
}
