<?php

declare(strict_types=1);

namespace App\Application\Command;

class CreateOrderCommand
{
    public string $productId;
    public int $qty;

    public function __construct(string $productId, int $qty)
    {
        $this->productId = $productId;
        $this->qty = $qty;
    }
}