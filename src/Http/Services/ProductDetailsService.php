<?php

namespace Hosam\ProductCrud\Http\Services;


use Hosam\ProductCrud\Models\Product;

class ProductDetailsService
{
    protected mixed $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function details($id)
    {
        return $this->model->with('productStock')->find($id);
    }

}
