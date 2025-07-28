<?php

namespace App\Domain\Entity;

class Product
{
    public function __construct(
        private string $id,
        private string $name,
        private float $price
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function price(): float
    {
        return $this->price;
    }
}
