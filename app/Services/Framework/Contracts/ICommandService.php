<?php

namespace App\Services\Framework\Contracts;

use App\Services\Framework\Services\Command\Commands\Command;
use App\Services\Framework\Services\Command\CommandService;

interface ICommandService
{
    public function boot(): void;

    public function execute(): void;

    public static function getInstance(): CommandService;

    /**
     * @return Command[]
     */
    public function getCommands(): array;
}