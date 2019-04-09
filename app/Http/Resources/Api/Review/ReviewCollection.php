<?php

namespace App\Http\Resources\Api\Review;

use Illuminate\Http\Resources\Json\Resource;

class ReviewCollection extends Resource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return[
            'customer'=>$this->customer,
            'review'=>$this->review,
            'star' => $this->rate,
            'ReviewShow'=>[
                'link'=>route('reviews.show',['product'=>$this->product_id,'review'=>$this->id])
            ]
        ];
    }
}
