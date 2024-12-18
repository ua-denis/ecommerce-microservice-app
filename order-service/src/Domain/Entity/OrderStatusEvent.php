<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use DateTimeImmutable;

class OrderStatusEvent
{
    private string $eventId;
    private string $orderId;
    private string $status;
    private DateTimeImmutable $occurredAt;

    public function __construct(string $orderId, string $status)
    {
        $this->eventId = uniqid('event-', true);
        $this->orderId = $orderId;
        $this->status = $status;
        $this->occurredAt = new DateTimeImmutable();
    }

    public function getEventId(): string
    {
        return $this->eventId;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getOccurredAt(): DateTimeImmutable
    {
        return $this->occurredAt;
    }
}