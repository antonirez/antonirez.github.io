<?php

namespace App\Application\Handler;

use App\Application\Command\UpdateItemQuantityCommand;
use App\Domain\Repository\CartRepositoryInterface;

class UpdateItemQuantityHandler
{
    public function __construct(private CartRepositoryInterface $carts)
    {
    }

    public function __invoke(UpdateItemQuantityCommand $command): void
    {
        $cart = $this->carts->get();
        $cart->updateItem($command->productId, $command->quantity);
        $this->carts->save($cart);
    }
}
