<?php

namespace Hosam\ProductCrud\Http\Repositories\Contract;


use Hosam\ProductCrud\Models\Order;

interface OrderInterface
{
    public function find(int $id);

    public function create($total_amount);

    public function update(int $id, array $data): bool;

    public function calculateTotalAmount($cartItems) ;
}
