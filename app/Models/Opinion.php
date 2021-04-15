<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opinion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rate',
        'comment'
    ];

    public function getOpinion($product_id, $user_id) {
        return $this::where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();
    }

    public function updateOpinion($product, $rate, $comment) {
        $user  = User::find(auth()->user()->id);
        $user->rate($product, $rate);

        $this::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->update([
            'rate' => $rate,
            'comment' => $comment
        ]);
    }

    public function getOpinions($product_id) {
        return $this::where('product_id', $product_id)
            ->leftJoin('users', 'opinions.user_id', '=', 'users.id')
            ->select('opinions.*', 'users.billing_name AS name')
            ->orderByDesc('opinions.updated_at')
            ->get();
    }

    public function destroyOpinion($product) {
        $user  = User::find(auth()->user()->id);
        $user->unrate($product);

        $this::where('product_id', $product->id)
            ->where('user_id', $user->id)
            ->delete();
    }
}
