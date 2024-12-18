<?php

declare(strict_types=1);

namespace App\Application\Command;

class CreateProductCommand
{
    public string $name;
    public float $price;
    public int $qty;

    public function __construct(string $name, float $price, int $qty)
    {
        $this->name = $name;
        $this->price = $price;
        $this->qty = $qty;
    }
}