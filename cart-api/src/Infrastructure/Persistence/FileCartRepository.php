<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Cart;
use App\Domain\Entity\Product;
use App\Domain\Repository\CartRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;

class FileCartRepository implements CartRepositoryInterface
{
    private string $file;

    public function __construct(private ProductRepositoryInterface $products, string $file)
    {
        $this->file = $file;
    }

    public function get(): Cart
    {
        if (!file_exists($this->file)) {
            return new Cart('default');
        }
        $data = json_decode(file_get_contents($this->file), true);
        $cart = new Cart($data['id']);
        foreach ($data['items'] as $item) {
            $product = $this->products->find($item['product_id']);
            if ($product) {
                $cart->addItem($product, $item['quantity']);
            }
        }
        return $cart;
    }

    public function save(Cart $cart): void
    {
        $data = [
            'id' => $cart->id(),
            'items' => []
        ];
        foreach ($cart->items() as $item) {
            $data['items'][] = [
                'product_id' => $item->product()->id(),
                'quantity' => $item->quantity()
            ];
        }
        file_put_contents($this->file, json_encode($data));
    }
}
