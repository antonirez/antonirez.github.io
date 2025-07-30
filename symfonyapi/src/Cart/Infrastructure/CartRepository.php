<?php

namespace App\Cart\Infrastructure;

use App\Cart\Domain\Cart;

class CartRepository
{
    public function __construct(private string $path)
    {
        if (!file_exists($this->path)) {
            file_put_contents($this->path, serialize(new Cart()));
        }
    }

    public function load(): Cart
    {
        return unserialize(file_get_contents($this->path));
    }

    public function save(Cart $cart): void
    {
        file_put_contents($this->path, serialize($cart));
    }
}
