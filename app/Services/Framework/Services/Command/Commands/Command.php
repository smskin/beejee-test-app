<?php

namespace App\Services\Framework\Services\Command\Commands;

use App\Services\Framework\Contracts\ICommand;

abstract class Command implements ICommand
{
    public static $signature;
    public static $description;

    public function execute(): void
    {
    }
}