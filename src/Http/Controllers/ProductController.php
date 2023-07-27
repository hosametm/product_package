<?php

namespace Hosam\ProductCrud\Http\Controllers;

use App\Http\Controllers\Controller;
use Hosam\ProductCrud\Http\Repositories\Contract\CartInterface;
use Hosam\ProductCrud\Http\Repositories\Contract\CategoryInterface;
use Hosam\ProductCrud\Http\Repositories\Eloquent\CategoryRepository;
use Hosam\ProductCrud\Http\Services\Product\ProductDestroyService;
use Hosam\ProductCrud\Http\Services\Product\ProductDetailsService;
use Hosam\ProductCrud\Http\Services\Product\ProductsService;
use Hosam\ProductCrud\Http\Services\Product\ProductStoreService;
use Hosam\ProductCrud\Http\Services\Product\ProductUpdateService;
use Hosam\ProductCrud\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productsService;
    private CategoryInterface $category;
    public function __construct(
        ProductsService $productsService,
        ProductStoreService $productStoreService,
        ProductDestroyService $productDestroyService,
        ProductDetailsService $productDetailsService,
        ProductUpdateService $productUpdateService,
        CategoryInterface $category
    ) {
        $this->productsService = $productsService;
        $this->productStoreService = $productStoreService;
        $this->productDestroyService = $productDestroyService;
        $this->productDetailsService = $productDetailsService;
        $this->productUpdateService = $productUpdateService;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productsService->allProducts();
        return view('product_crud::products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->all();
        return view('product_crud::products.create',compact('categories'));
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
        $categories = $this->category->all();
        return view('product_crud::products.edit', compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->productUpdateService->update($request, $id);
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource
     */
    public function destroy(ProductDestroyService $productDestroyService, $id)
    {
        $productDestroyService->destroy($id);
        return redirect(route('product.index'));
    }

}
