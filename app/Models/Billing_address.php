<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing_address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'choose_company',
        'name',
        'tax_num',
        'address_id',
    ];
}
