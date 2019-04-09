<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'customer',
        'review',
        'rate',
    ];

    public function product()
    {
        return $this->hasOne(Product::class);
    }
}
