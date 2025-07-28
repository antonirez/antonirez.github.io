<?php

require __DIR__.'/../vendor/autoload.php';

use App\Domain\Entity\Cart;
use App\Domain\Entity\Product;

$cart = new Cart('test');
$cart->addItem(new Product('p1', 'Test', 10), 2);
assert($cart->total() === 20.0);
$cart->updateItem('p1', 3);
assert($cart->total() === 30.0);
$cart->removeItem('p1');
assert($cart->total() === 0.0);

echo "Cart tests passed\n";
