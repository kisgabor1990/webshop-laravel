<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Nagy\LaravelRating\Traits\Rate\CanRate;


class User extends Authenticatable
{
    use HasFactory, Notifiable, CanRate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'choose_company',
        'phone',
        'billing_name',
        'billing_taxnum',
        'billing_city',
        'billing_address',
        'billing_zip',
        'shipping_name',
        'shipping_city',
        'shipping_address',
        'shipping_zip',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
}