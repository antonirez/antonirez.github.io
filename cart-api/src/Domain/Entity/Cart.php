<?php

namespace App\Domain\Entity;

class Cart
{
    /** @var CartItem[] */
    private array $items = [];

    public function __construct(private string $id)
    {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function items(): array
    {
        return array_values($this->items);
    }

    public function addItem(Product $product, int $quantity): void
    {
        if (isset($this->items[$product->id()])) {
            $this->items[$product->id()]->increaseQuantity($quantity);
        } else {
            $this->items[$product->id()] = new CartItem($product, $quantity);
        }
    }

    public function updateItem(string $productId, int $quantity): void
    {
        if (!isset($this->items[$productId])) {
            return;
        }
        if ($quantity <= 0) {
            unset($this->items[$productId]);
        } else {
            $this->items[$productId]->setQuantity($quantity);
        }
    }

    public function removeItem(string $productId): void
    {
        unset($this->items[$productId]);
    }

    public function total(): float
    {
        return array_reduce($this->items, fn($sum, CartItem $i) => $sum + $i->subtotal(), 0.0);
    }
}
