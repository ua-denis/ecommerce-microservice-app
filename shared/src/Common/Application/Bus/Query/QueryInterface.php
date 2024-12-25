<?php

declare(strict_types=1);

namespace Common\Application\Bus\Query;

interface QueryInterface
{
    public function getQueryId(): string;
}