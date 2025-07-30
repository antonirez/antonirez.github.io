<?php

namespace App\Controller;

use App\Cart\Application\CartManager;
use App\Cart\Application\CheckoutService;
use App\Cart\Domain\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    public function __construct(
        private CartManager $cartManager,
        private CheckoutService $checkout
    ) {}

    #[Route('/api/cart', methods: ['GET'])]
    public function cart(): JsonResponse
    {
        $cart = $this->cartManager->getCart();

        return $this->json([
            'items' => array_map(fn($item) => [
                'product' => [
                    'id' => $item->getProduct()->getId(),
                    'name' => $item->getProduct()->getName(),
                    'price' => $item->getProduct()->getPrice(),
                ],
                'quantity' => $item->getQuantity(),
                'total' => $item->getTotal(),
            ], $cart->items()),
            'total' => $cart->total(),
        ]);
    }

    #[Route('/api/cart/items', methods: ['POST'])]
    public function addItem(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $product = new Product($data['id'], $data['name'], $data['price']);
        $quantity = $data['quantity'] ?? 1;
        $this->cartManager->addProduct($product, $quantity);

        return $this->json(['status' => 'added']);
    }

    #[Route('/api/cart/items/{id}', methods: ['PUT'])]
    public function updateItem(string $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $quantity = $data['quantity'] ?? 1;
        $this->cartManager->updateProduct($id, $quantity);

        return $this->json(['status' => 'updated']);
    }

    #[Route('/api/cart/items/{id}', methods: ['DELETE'])]
    public function removeItem(string $id): JsonResponse
    {
        $this->cartManager->removeProduct($id);

        return $this->json(['status' => 'removed']);
    }

    #[Route('/api/cart/checkout', methods: ['POST'])]
    public function checkout(): JsonResponse
    {
        $cart = $this->cartManager->getCart();
        $order = $this->checkout->checkout($cart);
        $this->cartManager->clear();

        return $this->json(['orderId' => $order->getId()]);
    }
}
