<?php

namespace App\Services\Framework\Services\Command\Commands;

use App\Services\Framework\Contracts\ICommand;
use App\Services\Framework\Services\Command\CommandService;

class CommandsListCommand extends Command implements ICommand
{
    public static $signature = 'commands:list';
    public static $description = 'list all commands';

    public function execute(): void
    {
        $commands = CommandService::getInstance()->getCommands();

        echo 'Available commands:'.PHP_EOL;
        foreach ($commands as $signature => $class){
            echo $signature.' - '.$class::$description.PHP_EOL;
        }
    }
}