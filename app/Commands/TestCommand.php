<?php

namespace App\Commands;

use App\Services\Framework\Contracts\ICommand;
use App\Services\Framework\Services\Command\Commands\Command;

class TestCommand extends Command implements ICommand
{
    public static $signature = 'test:test';
    public static $description = 'test command';

    public function execute(): void
    {
        echo 'test command executed';
    }
}