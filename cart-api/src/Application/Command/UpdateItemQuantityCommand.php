<?php

namespace App\Application\Command;

class UpdateItemQuantityCommand
{
    public function __construct(
        public readonly string $productId,
        public readonly int $quantity
    ) {
    }
}
