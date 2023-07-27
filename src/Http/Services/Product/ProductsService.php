<?php

namespace Hosam\ProductCrud\Http\Services\Product;


use Hosam\ProductCrud\Models\Product;

class ProductsService
{
    public function allProducts()
    {
        return Product::with('productStock','category')->latest()->paginate();
    }
}
