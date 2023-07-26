<?php

namespace Hosam\ProductCrud\Http\Controllers;

use App\Http\Controllers\Controller;
use Hosam\ProductCrud\Http\Services\Product\ProductDestroyService;
use Hosam\ProductCrud\Http\Services\Product\ProductDetailsService;
use Hosam\ProductCrud\Http\Services\Product\ProductsService;
use Hosam\ProductCrud\Http\Services\Product\ProductStoreService;
use Hosam\ProductCrud\Http\Services\Product\ProductUpdateService;
use Hosam\ProductCrud\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productsService;

    public function __construct(
        ProductsService $productsService,
        ProductStoreService $productStoreService,
        ProductDestroyService $productDestroyService,
        ProductDetailsService $productDetailsService,
        ProductUpdateService $productUpdateService
    ) {
        $this->productsService = $productsService;
        $this->productStoreService = $productStoreService;
        $this->productDestroyService = $productDestroyService;
        $this->productDetailsService = $productDetailsService;
        $this->productUpdateService = $productUpdateService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productsService->allProducts();
//        $products = Product::with('productStock')->paginate();
        return view('product_crud::products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product_crud::products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->productStoreService->store($request);
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->productDetailsService->details($id);
        return view('product_crud::products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = $this->productDetailsService->details($id);
        return view('product_crud::products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->productUpdateService->update($request, $id);
        return redirect()->back();
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductDestroyService $productDestroyService, $id)
    {
        $productDestroyService->destroy($id);
        return redirect(route('product.index'));
    }

}
