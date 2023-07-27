<?php

namespace Hosam\ProductCrud\Http\Repositories\Contract;


use Hosam\ProductCrud\Models\Order;

interface OrderInterface
{
    public function find(int $id): ?Order;

    public function create(array $data): Order;

    public function update(int $id, array $data): bool;
}
