<?php

namespace App\Cart\Domain;

class Cart
{
    /** @var CartItem[] */
    private array $items = [];

    public function addProduct(Product $product, int $quantity = 1): void
    {
        if (isset($this->items[$product->getId()])) {
            $this->items[$product->getId()]->increase($quantity);
            return;
        }

        $this->items[$product->getId()] = new CartItem($product, $quantity);
    }

    public function updateItem(string $productId, int $quantity): void
    {
        if (isset($this->items[$productId])) {
            $this->items[$productId]->updateQuantity($quantity);
        }
    }

    public function removeItem(string $productId): void
    {
        unset($this->items[$productId]);
    }

    /**
     * @return CartItem[]
     */
    public function items(): array
    {
        return array_values($this->items);
    }

    public function total(): float
    {
        return array_sum(array_map(fn(CartItem $item) => $item->getTotal(), $this->items));
    }
}
