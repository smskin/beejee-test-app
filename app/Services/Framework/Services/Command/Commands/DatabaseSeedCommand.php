<?php

namespace App\Services\Framework\Services\Command\Commands;

use App\Services\Framework\Contracts\ICommand;

class DatabaseSeedCommand extends Command implements ICommand
{
    public static $signature = 'database:seed';
    public static $description = 'Run database seeds';

    public function execute(): void
    {
        $databaseService = app()->getDatabaseService();
        $databaseService->runSeeds();
    }
}