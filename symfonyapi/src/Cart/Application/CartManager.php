<?php

namespace App\Cart\Application;

use App\Cart\Domain\Cart;
use App\Cart\Domain\Product;
use App\Cart\Infrastructure\CartRepository;

class CartManager
{
    public function __construct(private CartRepository $repository)
    {
    }

    public function getCart(): Cart
    {
        return $this->repository->load();
    }

    public function addProduct(Product $product, int $quantity = 1): void
    {
        $cart = $this->repository->load();
        $cart->addProduct($product, $quantity);
        $this->repository->save($cart);
    }

    public function updateProduct(string $productId, int $quantity): void
    {
        $cart = $this->repository->load();
        $cart->updateItem($productId, $quantity);
        $this->repository->save($cart);
    }

    public function removeProduct(string $productId): void
    {
        $cart = $this->repository->load();
        $cart->removeItem($productId);
        $this->repository->save($cart);
    }

    public function clear(): void
    {
        $this->repository->save(new Cart());
    }
}
