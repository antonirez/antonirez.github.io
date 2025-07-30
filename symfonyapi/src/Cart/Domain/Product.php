<?php

namespace App\Cart\Domain;

class Product
{
    public function __construct(
        private string $id,
        private string $name,
        private float $price
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }
}
