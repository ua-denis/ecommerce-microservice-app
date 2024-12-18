<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use App\Domain\Entity\OrderStatusEvent;
use App\Domain\Repository\OrderStatusEventRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class DoctrineOrderStatusEventRepository implements OrderStatusEventRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(OrderStatusEvent::class);
    }

    public function save(OrderStatusEvent $event): void
    {
        $this->entityManager->persist($event);
        $this->entityManager->flush();
    }

    public function findByOrderId(string $orderId): array
    {
        return $this->repository->findBy(['orderId' => $orderId]);
    }
}