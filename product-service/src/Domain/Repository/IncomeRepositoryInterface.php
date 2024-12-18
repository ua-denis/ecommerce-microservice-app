<?php

declare(strict_types=1);

namespace App\Domain\Repository;

use App\Domain\Entity\Product;

interface IncomeRepositoryInterface
{
    public function update(Product $product): void;
}