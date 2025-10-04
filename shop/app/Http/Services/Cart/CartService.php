<?php

namespace App\Http\Services\Cart;

use Dompdf\Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;

class CartService
{
    public Builder $cart;
    public Builder $cartItem;

    public function __construct()
    {
        $this->cart = \App\Models\Cart::query();
        $this->cartItem = \App\Models\CartItem::query();
    }

    public function getCartByUserId($userId)
    {
        $cart = $this->cart->where('user_id', $userId)->first();
        if (!$cart) {
            $cart = $this->cart->create(['user_id' => $userId]);
        }
        return $cart->load("items");
    }

    /**
     * @throws Exception
     */
    public function updateCart(int $userId, array $data): void
    {
        $cart = $this->cart->where('user_id', $userId)->first();
        if (!$cart) {
            throw new Exception("Cart not found");
        }
        $this->cartItem->where('cart_id', $cart->id)->delete();
        if (!empty($data['items'])) {
            foreach ($data['items'] as $item) {
                $this->cartItem->updateOrCreate([
                    'cart_id' => $cart->id,
                    'product_id' => $item['product_id'],
                    'size_id' => $item['size_id'],
                ], [
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ]);
            }
        }
    }
}
