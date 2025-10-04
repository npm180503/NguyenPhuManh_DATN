<?php

namespace App\Http\Business;

use App\Http\Services\Cart\CartService;
use App\Http\Services\Product\ProductService;
use Exception;

/**
 * Trong kien truc DDD co aggreate
 * Co root => Cart
 * CartItem la con cua CART
 */
class Cart
{
    static Cart $cart;
    const CART_PREFIX = "cart_manage";
    protected array $cartItems = [];
    protected int $userId;
    protected string $cartKey;

    /**
     * @throws Exception
     */
    private function __construct($userId)
    {
        $this->userId = $userId;
        $this->cartKey = static::CART_PREFIX . "_" . $this->userId;
        $this->bindCart();
    }

    public static function getInstance(int $userId = null): Cart
    {
        if (empty(self::$cart)) self::$cart = new Cart($userId);
        return self::$cart;
    }

    public function addToCart(int $productId, int $sizeId, int $quantity): void
    {
        $product = resolve(ProductService::class)->product($productId);
        if (empty($product)) throw new Exception("Product Not Found");
        if ($quantity <= 0) throw new Exception("Quantity Invalid");
        if ($product->sizes->isEmpty()) throw new Exception("Product Size Not Found");
        if ($product->sizes->where('id', $sizeId)->isEmpty()) throw new Exception("Product Size Not Found");
        $keyItem = $this->hashKey($productId, $sizeId);
        if ($product->sizes->where('id', $sizeId)->first()->pivot->quantity < $quantity) {
            throw new Exception("Số lượng  sản phẩm trong kho không đủ");
        }
        if (!empty($this->cartItems) && !empty($this->cartItems[$keyItem])) {
            if ($product->sizes->where('id', $sizeId)->first()->pivot->quantity < $quantity + $this->cartItems[$keyItem]->quantity) {
                throw new Exception("Số lượng  sản phẩm trong kho không đủ");
            }
            $this->cartItems[$keyItem]->increase($quantity);
        } else {
            $cartItem = new CartItem($productId, $sizeId, $quantity);
            $this->cartItems[$keyItem] = $cartItem;
        }
        $this->syncCart();
    }

    /**
     * @throws Exception
     */
    public function updateCart($rowId, int $quantity)
    {
        if (empty($this->cartItems[$rowId])) throw new Exception("Cart Item Not Found");
        $item = $this->cartItems[$rowId];
        $product = resolve(ProductService::class)->product($item->productId);
        if (empty($product)) throw new Exception("Product Not Found");
        if ($quantity <= 0) throw new Exception("Quantity Invalid");
        if ($product->sizes->isEmpty()) throw new Exception("Product Size Not Found");
        if ($product->sizes->where('id', $item->sizeId)->isEmpty()) throw new Exception("Product Size Not Found");
        if ($product->sizes->where('id', $item->sizeId)->first()->pivot->quantity < $quantity) {
            throw new Exception("Số lượng  sản phẩm trong kho không đủ");
        }
        $item->updateQuantity($quantity);
        return $item;
    }

    public function removeCart($rowId): void
    {
        if (isset($this->cartItems[$rowId])) {
            unset($this->cartItems[$rowId]);
        }
        $this->syncCart();
    }

    public function content(): array
    {
        return $this->cartItems;
    }

    public function destroy(): void
    {
        $this->cartItems = [];
    }

    public function total(): string
    {
        $total = array_reduce($this->cartItems, function ($total, $item) {
            $total += $item->total();
            return $total;
        }, 0);
        return number_format($total);
    }

    public function rawTotal(): int
    {
        return array_reduce($this->cartItems, function ($total, $item) {
            $total += $item->total();
            return $total;
        }, 0);
    }

    public function refresh(): void
    {
        foreach ($this->cartItems as $item) {
            $item->refresh();
        }
    }

    public function __destruct()
    {
        $this->syncCart();
    }

    /**
     * @throws \Dompdf\Exception
     */
    private function syncCart(): void
    {
        $data['items'] = [];
        foreach ($this->cartItems as $item) {
            $data['items'][$this->hashKey($item->productId, $item->sizeId)] = [
                'quantity' => $item->quantity,
                'product_id' => $item->productId,
                'size_id' => $item->sizeId,
                'price' => $item->price,
            ];
        }
        resolve(CartService::class)->updateCart($this->userId, $data);
    }

    /**
     * @throws Exception
     */
    private function bindCart(): void
    {
        $cart = resolve(CartService::class)->getCartByUserId($this->userId);
        if (empty($cart)) throw new Exception("Cart Not Found");
        if (!$cart->items->isEmpty()) {
            foreach ($cart->items as $item) {
                $key = $this->hashKey($item->product_id, $item->size_id);
                $this->cartItems[$key] = new CartItem($item->product_id, $item->size_id, $item->quantity);
            }
        }
    }
    private function hashKey(int $productId, int $sizeId): string
    {
        return md5($productId . $sizeId);
    }
}
