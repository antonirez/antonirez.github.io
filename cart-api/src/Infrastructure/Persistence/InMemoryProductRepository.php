<?php

namespace App\Infrastructure\Persistence;

use App\Domain\Entity\Product;
use App\Domain\Repository\ProductRepositoryInterface;

class InMemoryProductRepository implements ProductRepositoryInterface
{
    /** @var Product[] */
    private array $products = [];

    public function __construct()
    {
        $this->products = [
            new Product('p1', 'Maillot', 35.0),
            new Product('p2', 'Culotte', 50.0),
            new Product('p3', 'Gafas', 60.0),
        ];
    }

    public function find(string $id): ?Product
    {
        foreach ($this->products as $product) {
            if ($product->id() === $id) {
                return $product;
            }
        }
        return null;
    }
}
