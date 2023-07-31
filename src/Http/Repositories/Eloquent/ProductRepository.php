<?php

namespace Hosam\ProductCrud\Http\Repositories\Eloquent;

use Hosam\ProductCrud\Http\Repositories\Contract\ProductInterface;
use Hosam\ProductCrud\Http\Services\Attachment\UploadAttachment;
use Hosam\ProductCrud\Models\Product;
use Illuminate\Http\Request;

class ProductRepository implements ProductInterface
{

    public function __construct(Product $model, UploadAttachment $storeAttachment)
    {
        $this->model = $model;
        $this->storeAttachment = $storeAttachment;
    }

    public function allProducts(Request $request)
    {
        return $this->model->with('productStock', 'category')->latest()->paginate();
    }

    public function store(Request|\http\Client\Request $request)
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

    public function update($request, $id)
    {
        $product = $this->details($id);

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

    public function details($id)
    {
        return $this->model->with('productStock')->find($id);
    }

    public function destroy($id)
    {
        $product = $this->details($id);
        $product->attachments()->delete();
        $product->productStock()->delete();
        $product->delete();
        return true;
    }
}
