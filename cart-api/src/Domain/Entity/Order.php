<?php

namespace App\Domain\Entity;

class Order
{
    public function __construct(
        private string $id,
        private array $items,
        private float $total
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function items(): array
    {
        return $this->items;
    }

    public function total(): float
    {
        return $this->total;
    }
}
