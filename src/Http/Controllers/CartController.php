<?php

namespace Hosam\ProductCrud\Http\Controllers;

use App\Http\Controllers\Controller;

use Hosam\ProductCrud\Http\Repositories\Contract\CartInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;


class CartController extends Controller
{
    protected $cart;

    public function __construct(CartInterface $cart)
    {
        $this->cart = $cart;
    }

    public function addToCart(Request $request)
    {
        try {
            $guestId = Cookie::get('temp_id');
            if (!$guestId) {
                $guestId = Str::uuid();
                Cookie::queue('temp_id', $guestId, 120);
            }
            $productId = $request->input('productId');
            $quantity = $request->input('quantity', 1);
            $this->cart->addToCart($productId, $quantity, $guestId);
            return back();
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function viewCart()
    {
        try {
            Cookie::get('temp_id') ?: Cookie::queue('temp_id', uniqid('guest-', true), 120);
            $carts = $this->cart->getCartItems();
            return view('product_crud::front.products.cart', compact('carts'));
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
        }
    }

    public function clearCart()
    {
        try {
            $this->cart->clearCart() ? $message = "success" : $message = 'failed';
            return back()->with(['message' => $message]);
        } catch (\Throwable $throwable) {
            dd($throwable->getMessage());
        }
    }

}
