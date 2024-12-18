<?php

declare(strict_types=1);

namespace App\Application\DTO;

class OrderDTO
{
    public string $id;
    public string $productId;
    public int $qty;
    public float $amount;

    public function __construct(string $id, string $productId, int $qty, float $amount)
    {
        $this->id = $id;
        $this->productId = $productId;
        $this->qty = $qty;
        $this->amount = $amount;
    }
}