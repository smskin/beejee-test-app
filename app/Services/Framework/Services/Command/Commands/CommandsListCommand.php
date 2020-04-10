<?php

namespace App\Services\Framework\Services\Command\Commands;

use App\Services\Framework\Contracts\ICommand;

class CommandsListCommand extends Command implements ICommand
{
    public static $signature = 'commands:list';
    public static $description = 'list all commands';

    public function execute(): void
    {
        $commandService = app()->getCommandService();
        $commands = $commandService->getCommands();

        echo 'Available commands:'.PHP_EOL;
        foreach ($commands as $signature => $class){
            echo $signature.' - '.$class::$description.PHP_EOL;
        }
    }
}