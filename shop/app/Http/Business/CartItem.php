<?php

namespace App\Http\Business;

use App\Http\Services\Product\ProductService;
use App\Models\Product;
use App\Models\Size;

class CartItem
{
    protected int $productId;
    protected int $sizeId;
    protected Size $size;
    protected int $quantity;
    protected int $price;
    protected Product $product;

    public function __construct(int $productId, int $sizeId, int $quantity)
    {
        $this->productId = $productId;
        $this->sizeId = $sizeId;
        $this->quantity = $quantity;
        $this->size = Size::find($this->sizeId);
        $this->product = resolve(ProductService::class)->show($productId);
        $this->price = $this->product->sale_price ?? $this->product->price;
    }

    public function __get($name)
    {
        return $this->{$name} ?? null;
    }

    public function increase(int $quantity)
    {
        $this->quantity += $quantity;
    }

    public function getSize()
    {
        return Size::find($this->sizeId); // Lấy size từ database
    }

    public function total()
    {
        return $this->price * $this->quantity;
    }

    public function updateQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function refresh()
    {
        $this->product = resolve(ProductService::class)->show($this->productId);
    }
}
