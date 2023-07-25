<?php

namespace Hosam\ProductCrud\Http\Services;


use Hosam\ProductCrud\Models\Product;

class ProductStoreService
{
    protected mixed $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }


    public function store($request)
    {
        $product = $this->model->create($request->except('_token', 'stock', 'images'));
        $product->productStock()->createMany($request->stock);
        if ($request->hasfile('images')) {
            $savedFile = new StoreAttachment($request->file('images'), 'images');
            $savedFile = $savedFile();
            if ($product && $savedFile) {
                $product->attachments()->createMany($savedFile);
            }
        }
        return $product;
    }


}
