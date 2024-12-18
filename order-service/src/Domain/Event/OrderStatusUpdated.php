<?php

declare(strict_types=1);

namespace App\Domain\Event;

use DateTimeImmutable;

class OrderStatusUpdated
{
    private string $orderId;
    private string $oldStatus;
    private string $newStatus;
    private DateTimeImmutable $updatedAt;

    public function __construct(string $orderId, string $oldStatus, string $newStatus)
    {
        $this->orderId = $orderId;
        $this->oldStatus = $oldStatus;
        $this->newStatus = $newStatus;
        $this->updatedAt = new DateTimeImmutable();
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getOldStatus(): string
    {
        return $this->oldStatus;
    }

    public function getNewStatus(): string
    {
        return $this->newStatus;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}