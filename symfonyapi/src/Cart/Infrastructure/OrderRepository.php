<?php

namespace App\Cart\Infrastructure;

use App\Cart\Domain\Order;

class OrderRepository
{
    private string $path;

    public function __construct(string $path)
    {
        $this->path = $path;
        if (!file_exists($this->path)) {
            file_put_contents($this->path, json_encode([]));
        }
    }

    public function save(Order $order): void
    {
        $orders = json_decode(file_get_contents($this->path), true);
        $orders[$order->getId()] = serialize($order);
        file_put_contents($this->path, json_encode($orders));
    }
}
