<?php

namespace App\Cart\Application;

use App\Cart\Domain\Cart;
use App\Cart\Domain\Order;
use App\Cart\Infrastructure\OrderRepository;

class CheckoutService
{
    public function __construct(private OrderRepository $orders)
    {
    }

    public function checkout(Cart $cart): Order
    {
        $order = new Order($cart);
        $this->orders->save($order);
        return $order;
    }
}
