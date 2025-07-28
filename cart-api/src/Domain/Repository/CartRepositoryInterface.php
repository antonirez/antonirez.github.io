<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Cart;

interface CartRepositoryInterface
{
    public function get(): Cart;
    public function save(Cart $cart): void;
}
