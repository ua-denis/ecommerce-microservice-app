<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Domain\Repository\IncomeRepositoryInterface;
use App\Domain\Repository\ProductRepositoryInterface;
use Exception;
use RuntimeException;

class IncomeService
{
    private ProductRepositoryInterface $productRepository;
    private IncomeRepositoryInterface $incomeRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        IncomeRepositoryInterface $incomeRepository
    ) {
        $this->productRepository = $productRepository;
        $this->incomeRepository = $incomeRepository;
    }

    /**
     * @throws Exception
     */
    public function updateIncomeOnProductCreation(int $productId, float $orderAmount): void
    {
        $product = $this->productRepository->find($productId);

        if ($product) {
            $updatedIncome = $product->getIncome() + $orderAmount;
            $product->setIncome($updatedIncome);

            $this->incomeRepository->update($product);
        } else {
            throw new RuntimeException('Product not found.');
        }
    }
}