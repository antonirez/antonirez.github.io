<?php

namespace App\Application\Handler;

use App\Application\Query\GetCartQuery;
use App\Domain\Repository\CartRepositoryInterface;
use App\Domain\Entity\Cart;

class GetCartHandler
{
    public function __construct(private CartRepositoryInterface $carts)
    {
    }

    public function __invoke(GetCartQuery $query): Cart
    {
        return $this->carts->get();
    }
}
