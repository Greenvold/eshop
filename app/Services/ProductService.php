<?php

namespace App\Services;

use App\Events\ProductCreated;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;

class ProductService {

    public function createProduct(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        $product->categories()->sync(Category::whereIn('id',$request['categories'])->get());

        event(new ProductCreated($product));

        return $product;
    }

    public function updateProduct(ProductUpdateRequest $request, $product)
    {
        $product->update($request->validated());

        $product->categories()->sync(Category::whereIn('id',$request['categories'])->get());

        //new event would be created here for update
        event(new ProductCreated($product));

        return $product;
    }
}