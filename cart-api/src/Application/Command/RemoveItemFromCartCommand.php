<?php

namespace App\Application\Command;

class RemoveItemFromCartCommand
{
    public function __construct(public readonly string $productId)
    {
    }
}
