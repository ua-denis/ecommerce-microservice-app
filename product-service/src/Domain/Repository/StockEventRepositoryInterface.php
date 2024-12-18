<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\StockEvent;

interface StockEventRepositoryInterface
{
    public function find(int $id): ?StockEvent;

    public function save(StockEvent $stockEvent): void;

    public function update(StockEvent $stockEvent): void;

    public function delete(int $id): void;

    /**
     * @return StockEvent[]
     */
    public function findAll(): array;

    /**
     * @return StockEvent[]
     */
    public function findByProductId(int $productId): array;

    /**
     * @return StockEvent[]
     */
    public function findByType(string $type): array;
}