<?php

namespace App\Models;

use App\Notifications\VerifyEmailQueued;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Nagy\LaravelRating\Traits\Rate\CanRate;
use App\Notifications\ResetPassword as ResetPasswordNotification;



class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, SoftDeletes, CanRate;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'password_must_change',
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

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailQueued);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }




    public function billing_address() {
        return $this->hasOne(Billing_address::class)->withTrashed();
    }

    public function shipping_address() {
        return $this->hasOne(Shipping_address::class)->withTrashed();
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function carts() {
        return $this->hasMany(Cart::class);
    }

    public static function admins() {
        return self::where('is_admin', '!=', '0')->get();
    }

}
