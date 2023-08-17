<?php

namespace Hosam\ProductCrud\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Hosam\ProductCrud\Http\Repositories\Contract\ProductInterface;
use Hosam\ProductCrud\Http\Services\Product\ProductsService;

use Hosam\ProductCrud\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(ProductInterface $product,Request $request)
    {
        $products = $product->allProducts($request);
        return view('product_crud::front.products.index', compact('products'));
    }

    public function productStocks(Product $product)
    {
        $product->load('productStock');
        return view('product_crud::front.products.stocks', compact('product'));
    }
}
