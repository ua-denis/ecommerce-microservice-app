<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

class ProductRepository
{
    private EntityManagerInterface $entityManager;
    private ObjectRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(Product::class);
    }

    public function find(int $id): ?Product
    {
        return $this->repository->find($id);
    }

    public function update(Product $product): void
    {
        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}