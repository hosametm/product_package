<?php

namespace Hosam\ProductCrud\Http\Services;


use Hosam\ProductCrud\Models\Product;

class ProductUpdateService
{
    protected mixed $request;

    public function __construct($request, $id)
    {
        $this->request = $request;
        $this->product = new ProductDetailsService($id);
    }

    public function __invoke()
    {
        return $this->update();
    }

    public function update()
    {
        $this->product->update($this->request->except('_token', 'stock', 'images'));
        if ($this->request->has('stock')) {
            foreach ($this->request->stock as $stock) {
                if (isset($stock['id'])
                    && $stock['id'] != null
                    && $stock['id'] != ''
                    && $stock['id'] != 0
                ) {
                    $this->product->productStock()->updateOrCreate(['id' => $stock['id']], $stock);
                } else {
                    $this->product->productStock()->create($stock);
                }
            }
        }

        if ($this->request->hasfile('images')) {
            $savedFile = new StoreAttachment($this->request->file('images'), 'images');
            $savedFile = $savedFile();
            if ($this->product && $savedFile) {
                $this->product->attachments()->createMany($savedFile);
            }
        }

        if ($this->request->has('deletedStock')) {
            $deletedStock = explode(',', $this->request->deletedStock);
            $deletedStock = array_filter($deletedStock);
            $this->product->productStock()->whereIn('id', $deletedStock)->delete();
        }

        return $this->product;
    }


}
