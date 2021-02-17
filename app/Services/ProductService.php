<?php

namespace App\Services;

use App\Events\ProductCreated;
use App\Http\Requests\ProductStoreRequest;
use App\Models\Product;

class ProductService {

    public function createProduct(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        event(new ProductCreated($product));

        return $product;
    }
}