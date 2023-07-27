<?php

namespace Hosam\ProductCrud\Http\Repositories\Eloquent;

use Hosam\ProductCrud\Http\Repositories\Contract\CartInterface;
use Hosam\ProductCrud\Models\Cart;


class CartRepository implements CartInterface
{

    public function addToCart(int $productId, int $quantity): void
    {
        // TODO: Implement addToCart() method.
        if ($item = $this->cartItem($productId)) {
            $item->update(['quantity' => $item->quantity + $quantity]);
        } else {
            $this->saveCartItem($productId, $quantity);
        }
    }

    public function getCartItems()
    {
        // TODO: Implement getCartItems() method.
        return auth()->check()
            ? auth()->user()?->carts()->get()
            : Cart::whereGuestId($_COOKIE['temp_id'])->get();
    }

    public function clearCart()
    {
        // TODO: Implement clearCart() method.
        return auth()->check()
            ? auth()->user()?->carts()->delete()
            : Cart::whereGuestId($_COOKIE['temp_id'])->delete();
    }

    private function cartItem($productId)
    {
        return auth()->check()
            ? auth()->user()?->carts()->whereProductId($productId)->first()
            : Cart::whereProductId($productId)->whereGuestId($_COOKIE['temp_id'])->first();
    }

    private function saveCartItem($productId, $quantity)
    {
        try {
            Cart::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'product_id' => $productId,
                'quantity' => $quantity,
                'guest_id' => auth()->check() ? null : $_COOKIE['temp_id']
            ]);
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
        }
    }
}
