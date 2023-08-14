<?php

namespace Hosam\ProductCrud\Http\Controllers\Front;

use App\Http\Controllers\Controller;

use Hosam\ProductCrud\Http\Services\Product\ProductsService;

use Hosam\ProductCrud\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductsService $productsService;

    public function __construct(
        ProductsService $productsService

    )
    {
        $this->productsService = $productsService;
    }

    public function index()
    {
        $products = $this->productsService->allProducts();
        return view('product_crud::front.products.index', compact('products'));
    }

    public function productStocks(Product $product)
    {
        $product->load('productStock');
        return view('product_crud::front.products.stocks', compact('product'));
    }
}
