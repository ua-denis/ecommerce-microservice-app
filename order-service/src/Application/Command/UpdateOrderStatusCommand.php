<?php

declare(strict_types=1);

namespace App\Application\Command;

class UpdateOrderStatusCommand
{
    private string $orderId;
    private string $status;

    public function __construct(string $orderId, string $status)
    {
        $this->orderId = $orderId;
        $this->status = $status;
    }

    public function getOrderId(): string
    {
        return $this->orderId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}