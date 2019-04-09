<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\ReviewRequest;
use App\Http\Resources\Api\Review\ReviewResource;
use App\Model\Api\Product;
use App\Model\Api\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Review\ReviewCollection as RevCollection;
use App\Http\Resources\Api\Review\ReviewResource as RevResource;
use Illuminate\Http\Response;

class ReviewsController extends Controller
{
    use ApiTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $product)
    {
        $reviews =  $product->reviews()->paginate(5);
        $resource = RevCollection::collection($reviews) ;
        return $resource;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Product $product,ReviewRequest $request)
    {
        $request['rate'] = $request->star;
        unset($request['star']);
        $review = new Review($request->all());
        $product->reviews()->save($review);
        $resource = new RevResource($review);
        return $this->apiResponse($resource,null,Response::HTTP_CREATED);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product,Review $review)
    {
        $resource =  new RevResource($review);
       return $this->apiResponse($resource,null,Response::HTTP_OK);
    }


    public function edit($id)
    {
        //
    }


    public function update(Product $product,Request $request, Review $review)
    {
        $rules = [
            'customer' => 'min:3|alpha_dash',
            'review' => 'min:6|string',
            'star' => 'integer|between:0,5',
        ];
           $this->validate($request, $rules);
        $request['rate'] = $request->star;
        unset($request['star']);
        $review->update($request->all());
        $resource = new ReviewResource($review);
        return $this->apiResponse($resource,null,Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product,Review $review)
    {
        $review->delete();
        return $this->apiResponse(null,null,Response::HTTP_NO_CONTENT);
    }
}
