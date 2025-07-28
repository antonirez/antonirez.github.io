<?php

namespace App\Application\Handler;

use App\Application\Command\AddItemToCartCommand;
use App\Domain\Repository\CartRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;

class AddItemToCartHandler
{
    public function __construct(
        private CartRepositoryInterface $carts,
        private ProductRepositoryInterface $products
    ) {
    }

    public function __invoke(AddItemToCartCommand $command): void
    {
        $cart = $carts = $this->carts->get();
        $product = $this->products->find($command->productId);
        if (!$product) {
            throw new \InvalidArgumentException('Product not found');
        }
        $cart->addItem($product, $command->quantity);
        $this->carts->save($cart);
    }
}
