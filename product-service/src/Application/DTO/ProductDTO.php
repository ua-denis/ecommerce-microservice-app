<?php

declare(strict_types=1);

namespace App\Application\DTO;

class ProductDTO
{
    public int $id;
    public string $name;
    public float $price;
    public int $qty;
    public float $income;

    public function __construct(int $id, string $name, float $price, int $qty, float $income)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->qty = $qty;
        $this->income = $income;
    }
}