<?php

declare(strict_types=1);

namespace App\Domain\Event;

class ProductCreated
{
    private int $productId;
    private float $orderAmount;

    public function __construct(int $productId, float $orderAmount)
    {
        $this->productId = $productId;
        $this->orderAmount = $orderAmount;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }
    
    public function getOrderAmount(): float
    {
        return $this->orderAmount;
    }
}