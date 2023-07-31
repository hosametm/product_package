<?php

namespace Hosam\ProductCrud\Http\Controllers;

use App\Http\Controllers\Controller;
use Hosam\ProductCrud\Http\Repositories\Contract\CategoryInterface;
use Hosam\ProductCrud\Http\Repositories\Contract\ProductInterface;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private CategoryInterface $category;
    private ProductInterface $productInterface;

    public function __construct(
        CategoryInterface $category,
        ProductInterface $productInterface
    ) {
        $this->category = $category;
        $this->productInterface = $productInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $products = $this->productInterface->allProducts($request);
        return view('product_crud::products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->category->all();
        return view('product_crud::products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->productInterface->store($request);
        return redirect(route('product.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->productInterface->details($id);
        return view('product_crud::products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = $this->productInterface->details($id);
        $categories = $this->category->all();
        return view('product_crud::products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $this->productInterface->update($request, $id);
        return redirect(route('product.index'));
    }

    /**
     * Remove the specified resource
     */
    public function destroy($id)
    {
        $this->productInterface->destroy($id);
        return redirect(route('product.index'));
    }

}
