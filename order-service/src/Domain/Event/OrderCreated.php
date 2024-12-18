<?php

declare(strict_types=1);

namespace App\Domain\Event;

use DateTimeImmutable;

class OrderCreated
{
    private string $orderId;
    private DateTimeImmutable $createdAt;

    public function __construct(string $orderId)
    {
        $this->orderId = $orderId;
        $this->createdAt = new DateTimeImmutable();
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}