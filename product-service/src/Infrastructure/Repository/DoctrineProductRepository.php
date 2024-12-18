<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Product;
use App\Domain\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class DoctrineProductRepository implements ProductRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(Product::class);
    }

    public function find(int $productId): ?Product
    {
        return $this->repository->find($productId);
    }

    /**
     * @param  Product  $product
     */
    public function save(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }

    /**
     * @param  Product  $product
     */
    public function update(Product $product): void
    {
        $this->entityManager->flush();
    }

    /**
     * @param  int  $id
     */
    public function delete(int $id): void
    {
        $product = $this->find($id);

        if ($product) {
            $this->entityManager->remove($product);
            $this->entityManager->flush();
        }
    }

    /**
     * @return Product[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}