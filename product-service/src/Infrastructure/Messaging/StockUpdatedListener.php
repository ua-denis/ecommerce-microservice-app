<?php

declare(strict_types=1);

namespace App\Infrastructure\Messaging;

use App\Domain\Event\StockUpdated;
use App\Domain\Repository\ProductRepositoryInterface;

class StockUpdatedListener
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function __invoke(StockUpdated $event): void
    {
        $productId = $event->getProductId();
        $newQuantity = (int)$event->getNewQuantity();

        $product = $this->productRepository->find($productId);

        if ($product) {
            $product->setStockQuantity($newQuantity);
            $this->productRepository->update($product);
        }
    }
}