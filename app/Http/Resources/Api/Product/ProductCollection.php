<?php

namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductCollection extends Resource
{
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'ProductName' => $this->name,
            'ProductRate' => round($this->reviews->count() > 0 ? $this->reviews->sum('rate') / $this->reviews->count() : 'not rated yet', 2),
            'ProductDiscount' => $this->discount,
            'ProductTotalPrice' => round($this->price - ($this->discount / 100 * $this->price), 2),
            'ProductShow' => [
                'link' => route('products.show', $this->id),
            ],
        ];
    }
}
