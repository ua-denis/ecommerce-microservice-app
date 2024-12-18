<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\StockEvent;
use App\Domain\Repository\StockEventRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class DoctrineStockEventRepository implements StockEventRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $this->entityManager->getRepository(StockEvent::class);
    }

    public function find(int $id): ?StockEvent
    {
        return $this->repository->find($id);
    }

    public function save(StockEvent $stockEvent): void
    {
        $this->entityManager->persist($stockEvent);
        $this->entityManager->flush();
    }

    public function update(StockEvent $stockEvent): void
    {
        $this->entityManager->flush();
    }

    public function delete(int $id): void
    {
        $stockEvent = $this->find($id);

        if ($stockEvent) {
            $this->entityManager->remove($stockEvent);
            $this->entityManager->flush();
        }
    }

    /**
     * @return StockEvent[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @return StockEvent[]
     */
    public function findByProductId(int $productId): array
    {
        return $this->repository->findBy(['product' => $productId]);
    }

    /**
     * @return StockEvent[]
     */
    public function findByType(string $type): array
    {
        return $this->repository->findBy(['type' => $type]);
    }
}