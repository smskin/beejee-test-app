<?php

namespace App\Services\Framework\Services\Command\Commands;

use App\Services\Framework\Contracts\ICommand;

class TestCommand extends Command implements ICommand
{
    public static $signature = 'test:test';
    public static $description = 'test command';

    public function execute(): void
    {
        echo 'Test command execute' . PHP_EOL;
    }
}