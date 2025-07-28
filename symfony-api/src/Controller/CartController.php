<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CartController
{
    private static array $cart = [];

    public function get(): JsonResponse
    {
        return new JsonResponse(self::$cart);
    }

    public function add(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        self::$cart[] = [
            'product' => $data['product'] ?? 'unknown',
            'qty' => (int) ($data['qty'] ?? 1),
        ];
        return new JsonResponse(['status' => 'added']);
    }

    public function checkout(): JsonResponse
    {
        $order = ['items' => self::$cart, 'total' => count(self::$cart)];
        self::$cart = [];
        return new JsonResponse(['order' => $order]);
    }
}
