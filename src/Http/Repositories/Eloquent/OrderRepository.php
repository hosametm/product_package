<?php

namespace Hosam\ProductCrud\Http\Repositories\Eloquent;

use Hosam\ProductCrud\Http\Repositories\Contract\OrderInterface;
use \Hosam\ProductCrud\Models\Order;
use Hosam\ProductCrud\Models\OrderItem;

class OrderRepository implements OrderInterface
{

    public function find(int $id)
    {
        return Order::find($id);
    }

    public function create($total_amount)
    {
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'total_amount' => $total_amount,
            'status' => 0
        ]);

        $order->items()->createMany($this->orderItemsRows());
        return (bool)$order;
    }

    public function update(int $id, array $data): bool
    {
    }

    public function calculateTotalAmount($cartItems)
    {
        $items = collect(auth()->user()->carts);
        $total_amount = 0;
        $items->map(function ($item) use (&$total_amount) {
            $total_amount += ($item->quantity * (float)$item->stock->price);
        });
        return $total_amount;
    }

    private function orderItemsRows()
    {

        return auth()->user()->carts->map(function ($cartItem) {
            return [
                "product_stock_id" => $cartItem->product_stock_id,
                "quantity" => $cartItem->quantity,
                "price" => $cartItem->quantity * (float)$cartItem->stock?->price,
            ];
        });
    }
}
