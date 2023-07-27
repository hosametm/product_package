<?php

namespace Hosam\ProductCrud\Http\Repositories\Contract;

use Hosam\ProductCrud\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryInterface
{
    public function all(): LengthAwarePaginator;

    public function find($id): Category;

    public function store(array $data): RedirectResponse;

    public function update($id, array $data): RedirectResponse;

    public function delete($id): bool;
}
