<?php

use App\Cart\Domain\Cart;
use App\Cart\Domain\Product;
use PHPUnit\Framework\TestCase;

class CartTest extends TestCase
{
    public function testAddProduct(): void
    {
        $cart = new Cart();
        $cart->addProduct(new Product('1', 'Maillot', 10.0), 2);

        $this->assertCount(1, $cart->items());
        $this->assertEquals(20.0, $cart->total());
    }
}
