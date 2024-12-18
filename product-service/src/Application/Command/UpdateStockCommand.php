<?php

declare(strict_types=1);

namespace App\Application\Command;

class UpdateStockCommand
{
    private int $productId;
    private float $quantity;

    public function __construct(int $productId, float $quantity)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
    }

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }
}