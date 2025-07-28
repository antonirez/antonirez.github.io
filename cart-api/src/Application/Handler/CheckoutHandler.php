<?php

namespace App\Application\Handler;

use App\Application\Command\CheckoutCommand;
use App\Domain\Entity\Order;
use App\Domain\Repository\CartRepositoryInterface;
use App\Domain\Repository\OrderRepositoryInterface;

class CheckoutHandler
{
    public function __construct(
        private CartRepositoryInterface $carts,
        private OrderRepositoryInterface $orders
    ) {
    }

    public function __invoke(CheckoutCommand $command): Order
    {
        $cart = $this->carts->get();
        $order = new Order(uniqid('order_'), $cart->items(), $cart->total());
        $this->orders->save($order);
        // Reset cart
        $this->carts->save(new \App\Domain\Entity\Cart($cart->id()));
        return $order;
    }
}
