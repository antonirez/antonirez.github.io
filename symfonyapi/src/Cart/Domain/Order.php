<?php

namespace App\Cart\Domain;

class Order
{
    private string $id;

    public function __construct(private Cart $cart)
    {
        $this->id = uniqid('order_', true);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCart(): Cart
    {
        return $this->cart;
    }
}
