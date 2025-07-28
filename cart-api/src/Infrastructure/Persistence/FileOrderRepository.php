<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Order;
use App\Domain\Repository\OrderRepositoryInterface;

class FileOrderRepository implements OrderRepositoryInterface
{
    private string $file;

    public function __construct(string $file)
    {
        $this->file = $file;
    }

    public function save(Order $order): void
    {
        $orders = [];
        if (file_exists($this->file)) {
            $orders = json_decode(file_get_contents($this->file), true);
        }
        $orders[] = [
            'id' => $order->id(),
            'items' => array_map(fn($item) => [
                'product_id' => $item->product()->id(),
                'quantity' => $item->quantity(),
                'price' => $item->product()->price()
            ], $order->items()),
            'total' => $order->total()
        ];
        file_put_contents($this->file, json_encode($orders));
    }
}
