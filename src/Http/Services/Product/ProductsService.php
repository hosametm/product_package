<?php

namespace Hosam\ProductCrud\Http\Services\Product;


use Hosam\ProductCrud\Models\Product;
use http\Client\Request;

class ProductsService
{
    public function allProducts(Request $request)
    {
        return Product::with('productStock', 'category')->latest()->paginate();
    }
}
