<?php

declare(strict_types=1);

namespace Common\Application\Bus\Command;

interface CommandInterface
{
    public function getCommandId(): string;
}