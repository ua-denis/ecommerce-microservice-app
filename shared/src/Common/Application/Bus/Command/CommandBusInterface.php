<?php

declare(strict_types=1);

namespace Common\Application\Bus\Command;

interface CommandBusInterface
{
    public function handle(CommandInterface $command): void;
}