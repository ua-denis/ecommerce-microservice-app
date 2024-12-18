<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence;


use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class DatabaseConnection
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * @throws Exception
     */
    public function executeQuery(string $query, array $params = []): void
    {
        $this->connection->executeQuery($query, $params);
    }

    /**
     * @throws Exception
     */
    public function fetchOne(string $query, array $params = []): ?array
    {
        return $this->connection->fetchAssociative($query, $params);
    }

    /**
     * @throws Exception
     */
    public function fetchAll(string $query, array $params = []): array
    {
        return $this->connection->fetchAllAssociative($query, $params);
    }
}