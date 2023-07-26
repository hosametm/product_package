<?php

namespace Hosam\ProductCrud\Http\Services\Product;

use Hosam\ProductCrud\Http\Services\Attachment\UploadAttachment;
use Hosam\ProductCrud\Models\Product;

class ProductStoreService
{
    protected mixed $model;

    public function __construct(Product $product,UploadAttachment $storeAttachment)
    {
        $this->model = $product;
        $this->storeAttachment = $storeAttachment;
    }


    public function store($request)
    {
        $product = $this->model->create($request->except('_token', 'stock', 'images'));
        $product->productStock()->createMany($request->stock);
        if ($request->hasfile('images')) {
            $savedFile = $this->storeAttachment->store($request->file('images'), 'images');
            if ($product && $savedFile) {
                $product->attachments()->createMany($savedFile);
            }
        }
        return $product;
    }


}
