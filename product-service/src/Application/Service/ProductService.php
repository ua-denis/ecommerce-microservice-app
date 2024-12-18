<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Command\CreateProductCommand;
use App\Application\DTO\ProductDTO;
use App\Domain\Entity\Product;
use App\Domain\Repository\ProductRepositoryInterface;

class ProductService
{
    private ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function createProduct(CreateProductCommand $command): ProductDTO
    {
        $product = new Product($command->name, $command->price, $command->qty);

        $this->productRepository->save($product);

        return new ProductDTO(
            $product->getId(),
            $product->getName(),
            $product->getPrice(),
            $product->getQty(),
            $product->getIncome()
        );
    }

}