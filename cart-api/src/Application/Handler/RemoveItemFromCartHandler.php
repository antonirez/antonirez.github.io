<?php

namespace App\Application\Handler;

use App\Application\Command\RemoveItemFromCartCommand;
use App\Domain\Repository\CartRepositoryInterface;

class RemoveItemFromCartHandler
{
    public function __construct(private CartRepositoryInterface $carts)
    {
    }

    public function __invoke(RemoveItemFromCartCommand $command): void
    {
        $cart = $this->carts->get();
        $cart->removeItem($command->productId);
        $this->carts->save($cart);
    }
}
