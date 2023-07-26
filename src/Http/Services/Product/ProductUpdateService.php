<?php

namespace Hosam\ProductCrud\Http\Services\Product;


use Hosam\ProductCrud\Http\Services\Attachment\UploadAttachment;

class ProductUpdateService
{


    public function __construct(
        ProductDetailsService $productDetailsService,
        UploadAttachment $storeAttachment
    ) {
        $this->productDetailsService = $productDetailsService;
        $this->storeAttachment = $storeAttachment;
    }


    public function update($request, $id)
    {
        $product = $this->productDetailsService->details($id);
        $product->update($request->except('_token', 'stock', 'images'));


        if ($request->has('stock')) {
            foreach ($request->stock as $stock) {
                if (isset($stock['id'])
                    && $stock['id'] != null
                    && $stock['id'] != ''
                    && $stock['id'] != 0
                ) {
                    $product->productStock()->updateOrCreate(['id' => $stock['id']], $stock);
                } else {
                    $product->productStock()->create($stock);
                }
            }
        }


        if ($request->hasfile('images')) {
            $savedFiles = $this->storeAttachment->store($request->file('images'), 'images');
            if ($savedFiles) {
                $product->attachments()->createMany($savedFiles);
            }
        }


        if ($request->has('deletedStock')) {
            $deletedStock = explode(',', $request->deletedStock);
            $deletedStock = array_filter($deletedStock);
            $product->productStock()->whereIn('id', $deletedStock)->delete();
        }

        return $product;
    }
}
