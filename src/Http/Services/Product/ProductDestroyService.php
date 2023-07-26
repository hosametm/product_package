<?php

namespace Hosam\ProductCrud\Http\Services\Product;


class ProductDestroyService
{
    protected mixed $model;

    public function destroy($id)
    {
        $product = ProductDetailsService::details($id);
        $product->attachments()->delete();
        $product->productStock()->delete();
        $product->delete();
        return true;
    }

}
