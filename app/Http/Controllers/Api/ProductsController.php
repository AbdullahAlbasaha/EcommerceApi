<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Api\Product\ProductCollection as ProCollection;
use App\Http\Resources\Api\Product\ProductResource as ProResource;
use App\Model\Api\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductsController extends Controller
{
    use ApiTrait;

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }

    public function index()
    {
        $products = Product::paginate(15);
        return ProCollection::collection($products);
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product;
        $product->user_id = auth()->id();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->details = $request->details;
        $product->discount = $request->discount;
        $product->stock = $request->stock;
        $product->save();
        return $this->apiResponse($product, null, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $this->apiResponse(new ProResource($product), null, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $rules = [
            'name' => 'string|unique:Products',
            'price' => 'numeric|between:1,99999999',
            'details' => 'string',
            'discount' => 'numeric|max:50',
            'stock' => 'numeric|max:100',
        ];
        if(auth()->id() !== $product->user_id)
            return $this->apiResponse(null,'Product Not Belongs To User !',Response::HTTP_NON_AUTHORITATIVE_INFORMATION);
        $this->validate($request, $rules);
        $product->update($request->all());
        return $this->apiResponse($product, null, Response::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if(auth()->id() !== $product->user_id)
        return $this->apiResponse(null,'Product Not Belongs To User !',Response::HTTP_NON_AUTHORITATIVE_INFORMATION);
        $product->delete();
        return $this->apiResponse(null,null,Response::HTTP_NO_CONTENT);
    }
}
