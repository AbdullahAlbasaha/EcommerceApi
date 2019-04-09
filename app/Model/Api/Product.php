<?php

namespace App\Model\Api;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'price',
        'details',
        'discount',
        'stock',
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
