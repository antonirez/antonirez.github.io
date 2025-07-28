<?php

namespace App\Application\Command;

class AddItemToCartCommand
{
    public function __construct(
        public readonly string $productId,
        public readonly int $quantity
    ) {
    }
}
