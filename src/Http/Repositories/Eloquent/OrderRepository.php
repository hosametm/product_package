<?php

namespace Hosam\ProductCrud\Http\Repositories\Eloquent;

use App\Models\Order;
use Hosam\ProductCrud\Http\Repositories\Contract\OrderInterface;

class OrderRepository implements OrderInterface
{

    public function find(int $id): ?Order
    {
        // TODO: Implement find() method.
    }

    public function create(array $data): Order
    {
        // TODO: Implement create() method.
    }

    public function update(int $id, array $data): bool
    {
        // TODO: Implement update() method.
    }
}
