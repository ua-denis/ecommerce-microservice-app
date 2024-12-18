<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller;

use App\Application\Command\CreateProductCommand;
use App\Application\Service\IncomeService;
use App\Application\Service\ProductService;
use App\Domain\Event\ProductCreated;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;


class ProductController
{
    private ProductService $productService;
    private IncomeService $incomeService;
    private MessageBusInterface $messageBus;

    public function __construct(
        ProductService $productService,
        IncomeService $incomeService,
        MessageBusInterface $messageBus
    ) {
        $this->productService = $productService;
        $this->incomeService = $incomeService;
        $this->messageBus = $messageBus;
    }

    /**
     * @Route("/products", methods={"POST"})
     */
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreateProductCommand($data['name'], $data['price'], $data['qty']);
        $productDTO = $this->productService->createProduct($command);

        return new JsonResponse($productDTO, Response::HTTP_CREATED);
    }

    /**
     * @Route("/product/{productId}/create-order", name="create_product_order", methods={"POST"})
     */
    public function createProductOrder(int $productId, Request $request): Response
    {
        $orderAmount = (float)$request->get('orderAmount');

        try {
            $this->incomeService->updateIncomeOnProductCreation($productId, $orderAmount);

            return new Response('Income updated successfully.', Response::HTTP_OK);
        } catch (Exception $e) {
            return new Response('Error: '.$e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
    }

    public function createProductAction(int $productId, float $orderAmount): void
    {
        $productCreatedEvent = new ProductCreated($productId, $orderAmount);

        $this->messageBus->dispatch($productCreatedEvent);
    }
}