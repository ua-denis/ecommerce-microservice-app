<?php

declare(strict_types=1);

namespace Common\Infrastructure\Persistence\Repository;

interface RepositoryInterface
{
    public function save(object $entity): void;

    public function findById(string $id): ?object;
}