<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\OrderStatusEvent;

interface OrderStatusEventRepositoryInterface
{
    public function save(OrderStatusEvent $event): void;

    /**
     * @return OrderStatusEvent[]
     */
    public function findByOrderId(string $orderId): array;
}