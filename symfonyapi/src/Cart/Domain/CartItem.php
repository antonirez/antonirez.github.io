<?php

namespace App\Cart\Domain;

class CartItem
{
    public function __construct(
        private Product $product,
        private int $quantity = 1
    ) {}

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function updateQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function increase(int $amount = 1): void
    {
        $this->quantity += $amount;
    }

    public function decrease(int $amount = 1): void
    {
        $this->quantity = max(0, $this->quantity - $amount);
    }

    public function getTotal(): float
    {
        return $this->product->getPrice() * $this->quantity;
    }
}
