<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'taxnum',
        'choose_company',
    ];

    public function address() {
        return $this->belongsTo(Address::class);
    }
}
