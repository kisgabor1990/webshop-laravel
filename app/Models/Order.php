<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'payment',
        'shipping_mode',
        'shipping_price',
        'amount',
        'isPaid',
        'status',
        'comment',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function billing() {
        return $this->belongsTo(Order_billing::class);
    }

    public function shipping() {
        return $this->belongsTo(Order_shipping::class);
    }

    public function products() {
        return $this->belongsToMany(Product::class)->withPivot(['product_name', 'quantity', 'price']);
    }
}
