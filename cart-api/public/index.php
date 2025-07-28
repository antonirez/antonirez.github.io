<?php

require __DIR__.'/../vendor/autoload.php';

use App\Application\Command\AddItemToCartCommand;
use App\Application\Command\CheckoutCommand;
use App\Application\Command\RemoveItemFromCartCommand;
use App\Application\Command\UpdateItemQuantityCommand;
use App\Application\Handler\AddItemToCartHandler;
use App\Application\Handler\CheckoutHandler;
use App\Application\Handler\GetCartHandler;
use App\Application\Handler\RemoveItemFromCartHandler;
use App\Application\Handler\UpdateItemQuantityHandler;
use App\Application\Query\GetCartQuery;
use App\Infrastructure\Persistence\FileCartRepository;
use App\Infrastructure\Persistence\FileOrderRepository;
use App\Infrastructure\Persistence\InMemoryProductRepository;

$products = new InMemoryProductRepository();
$carts = new FileCartRepository($products, __DIR__.'/../storage/cart.json');
$orders = new FileOrderRepository(__DIR__.'/../storage/orders.json');

$addItem = new AddItemToCartHandler($carts, $products);
$updateItem = new UpdateItemQuantityHandler($carts);
$removeItem = new RemoveItemFromCartHandler($carts);
$getCart = new GetCartHandler($carts);
$checkout = new CheckoutHandler($carts, $orders);

$method = $_SERVER['REQUEST_METHOD'];
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

header('Content-Type: application/json');

function send($data, int $code = 200): void
{
    http_response_code($code);
    echo json_encode($data);
    exit;
}

if ($method === 'POST' && $path === '/cart/items') {
    $data = json_decode(file_get_contents('php://input'), true);
    $command = new AddItemToCartCommand($data['product_id'], $data['quantity'] ?? 1);
    $addItem($command);
    send(['status' => 'ok']);
}

if ($method === 'PUT' && preg_match('#^/cart/items/(?P<id>[^/]+)$#', $path, $m)) {
    $data = json_decode(file_get_contents('php://input'), true);
    $command = new UpdateItemQuantityCommand($m['id'], $data['quantity']);
    $updateItem($command);
    send(['status' => 'ok']);
}

if ($method === 'DELETE' && preg_match('#^/cart/items/(?P<id>[^/]+)$#', $path, $m)) {
    $command = new RemoveItemFromCartCommand($m['id']);
    $removeItem($command);
    send(['status' => 'ok']);
}

if ($method === 'GET' && $path === '/cart') {
    $cart = $getCart(new GetCartQuery());
    $items = [];
    foreach ($cart->items() as $item) {
        $items[] = [
            'product_id' => $item->product()->id(),
            'name' => $item->product()->name(),
            'price' => $item->product()->price(),
            'quantity' => $item->quantity(),
            'subtotal' => $item->subtotal()
        ];
    }
    send(['items' => $items, 'total' => $cart->total()]);
}

if ($method === 'POST' && $path === '/checkout') {
    $order = $checkout(new CheckoutCommand());
    send(['order_id' => $order->id(), 'total' => $order->total()]);
}

send(['error' => 'Not Found'], 404);
