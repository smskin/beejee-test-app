<?php

namespace App\Services\Framework\Contracts;

use App\Services\Framework\Services\Command\Commands\Command;

interface ICommandService
{
    public function execute(): void;

    /**
     * @return Command[]
     */
    public function getCommands(): array;
}