<?php

namespace App\Domain\Entity;

class CartItem
{
    public function __construct(
        private Product $product,
        private int $quantity
    ) {
    }

    public function product(): Product
    {
        return $this->product;
    }

    public function quantity(): int
    {
        return $this->quantity;
    }

    public function increaseQuantity(int $amount): void
    {
        $this->quantity += $amount;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function subtotal(): float
    {
        return $this->product->price() * $this->quantity;
    }
}
