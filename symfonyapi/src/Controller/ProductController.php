<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    public function __construct(private ProductRepository $products)
    {
    }

    #[Route('/api/products', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $data = array_map(fn(Product $p) => [
            'id' => $p->getId(),
            'name' => $p->getName(),
            'price' => $p->getPrice(),
        ], $this->products->findAll());

        return $this->json($data);
    }

    #[Route('/api/products', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        if (!is_array($data) || !isset($data['id'], $data['name'], $data['price'])) {
            return $this->json(['error' => 'Invalid data'], 400);
        }

        $product = (new Product())
            ->setId($data['id'])
            ->setName($data['name'])
            ->setPrice((float) $data['price']);

        $em->persist($product);
        $em->flush();

        return $this->json(['id' => $product->getId()], 201);
    }
}
