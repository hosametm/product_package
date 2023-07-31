<?php

namespace Hosam\ProductCrud\Http\Repositories\Contract;

use Illuminate\Http\Request;

interface ProductInterface
{
    public function allProducts(Request $request);

    public function store(Request $request);

    public function update($request, $id);

    public function details($id);

    public function destroy($id);

}
