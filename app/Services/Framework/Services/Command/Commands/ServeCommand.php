<?php

namespace App\Services\Framework\Services\Command\Commands;

use App\Services\Framework\Contracts\ICommand;

class ServeCommand extends Command implements ICommand
{
    public static $signature = 'serve';
    public static $description = 'Start development server';

    public function execute(): void
    {
        $host = 'localhost';
        $port = '8000';
        echo 'PHP Development Server started at '.date('r').PHP_EOL;
        echo 'Listening on http://'.$host.':'.$port.PHP_EOL;
        echo 'Document root is '.base_path().DIRECTORY_SEPARATOR.'public'.PHP_EOL;
        exec('php -S '.$host.':'.$port.' -t public');
    }
}