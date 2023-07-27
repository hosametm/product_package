<?php

namespace Hosam\ProductCrud\Http\Repositories\Eloquent;

use Hosam\ProductCrud\Http\Repositories\Contract\CategoryInterface;
use Hosam\ProductCrud\Http\Services\Product\ProductDetailsService;
use Hosam\ProductCrud\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryInterface
{

    public function all(): LengthAwarePaginator
    {
        // TODO: Implement all() method.
        return Category::latest()->paginate();
    }

    public function find($id): Category
    {
        // TODO: Implement find() method.
        return Category::find($id);
    }

    public function store(array $data): RedirectResponse
    {
        // TODO: Implement create() method.
        try {
            Category::create($data);
            return back()->with(['message' => 'success']);
        } catch (\Exception $exception) {
            return back()->with(['message' => 'failed']);
        }
    }

    public function update($id, array $data): RedirectResponse
    {
        // TODO: Implement update() method.
        try {
            $item = Category::find($id);
            $item->update($data);
            return back()->with(['message' => 'success']);
        } catch (\Exception $exception) {
            return back()->with(['message' => 'failed']);
        }
    }

    public function delete($id): bool
    {
        // TODO: Implement delete() method.
        return $this->find($id)->delete();

    }

}
