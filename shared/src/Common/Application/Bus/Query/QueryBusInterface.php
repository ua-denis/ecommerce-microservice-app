<?php

declare(strict_types=1);

namespace Common\Application\Bus\Query;

interface QueryBusInterface
{
    public function execute(QueryInterface $query): mixed;
}