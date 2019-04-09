<?php

namespace App\Http\Resources\Api\Product;

use Illuminate\Http\Resources\Json\Resource;

class ProductResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' =>$this->id,
            'name'=>$this->name,
            'details'=>$this->details,
            'price'=>$this->price,
            'stock'=>! $this->stock?:$this->stock,
            'discount'=>$this->discount,
            'totalPrice'=>round((1 - ($this->discount /100) )* $this->price,2),
            'rate'=> $this->reviews->count() > 0 ?round($this->reviews->sum('rate') /$this->reviews->count(),2):'not rated yet',
            'reviews'=>[
                'link'=>route('reviews.index',$this->id),
            ],

        ];
    }
}
