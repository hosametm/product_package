<?php

namespace Hosam\ProductCrud\Http\Services;


use Hosam\ProductCrud\Models\Product;

class ProductCrudService
{

    public function index()
    {
        return Product::with('productStock')->paginate();
    }

    public function details($id)
    {
        return Product::with('productStock')->find($id);
    }

    public function store($request)
    {
        $product = Product::create($request->except('_token', 'stock', 'images'));
        $product->productStock()->createMany($request->stock);
        $savedFile = new StoreAttachment($request->file('images'), 'images');
        $savedFile = $savedFile();
        if ($product && $savedFile) {
            $product->attachments()->createMany($savedFile);
        }
        return $product;
    }

    public function update($request, $product)
    {
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
            $savedFile = new StoreAttachment($request->file('images'), 'images');
            $savedFile = $savedFile();
            if ($product && $savedFile) {
                $product->attachments()->createMany($savedFile);
            }
        }

        if ($request->has('deletedStock')) {
            $deletedStock = explode(',', $request->deletedStock);
            $deletedStock = array_filter($deletedStock);
            $product->productStock()->whereIn('id', $deletedStock)->delete();
        }

        return $product;
    }

    public function destroy($product)
    {
        $product->attachments()->delete();
        $product->productStock()->delete();
        $product->delete();
        return true;
    }
}
