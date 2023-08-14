<?php

namespace Hosam\ProductCrud\Http\Services\Product;


use Hosam\ProductCrud\Models\Product;

class ProductDetailsService
{
    public static function details($id)
    {
        return Product::with('productStock')->find($id);
    }

}
