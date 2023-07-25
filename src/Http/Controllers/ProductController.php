<?php

namespace Hosam\ProductCrud\Http\Controllers;

use App\Http\Controllers\Controller;
use Hosam\ProductCrud\Http\Services\ProductCrudService;
use Hosam\ProductCrud\Http\Services\ProductDetailsService;
use Hosam\ProductCrud\Http\Services\ProductStoreService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productCrudService;

    public function __construct(ProductCrudService $productCrudService)
    {
        $this->productCrudService = $productCrudService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productCrudService->index();
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
    public function store(Request $request, ProductStoreService $productStoreService)
    {
        $productStoreService->store($request);
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductDetailsService $productDetailsService, $id)
    {
        $product = $productDetailsService->details($id);
        return view('product_crud::products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductDetailsService $productDetailsService, $id)
    {
        $product = $productDetailsService->details($id);
        return view('product_crud::products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $product = $this->productCrudService->details($id);
        $product = $this->productCrudService->update($request, $product);
        return redirect()->back();
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = $this->productCrudService->details($id);
        $this->productCrudService->destroy($product);
        return redirect(route('product.index'));
    }
}
