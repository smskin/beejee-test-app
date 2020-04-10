<?php


namespace App\Services\Framework\Services\Command;

use App\Commands\Kernel;
use App\Services\Framework\Contracts\ICommandService;
use App\Services\Framework\Services\Command\Commands\Command;
use App\Services\Framework\Services\Command\Commands\CommandsListCommand;
use App\Services\Framework\Services\Command\Commands\ServeCommand;
use App\Services\Framework\Services\Command\Commands\TestCommand;
use Exception;

class CommandService implements ICommandService
{
    protected $commands = [];

    public function boot(): void
    {
        $this->loadCommands();
    }

    private function loadCommands(): void
    {
        $commands = array_merge(
            Kernel::$commands,
            [
                TestCommand::class,
                CommandsListCommand::class,
                ServeCommand::class
            ]
        );

        foreach ($commands as $command) {
            $signature = $command::$signature;
            if (array_key_exists($signature, $this->commands)) {
                continue;
            }
            $this->commands[$signature] = $command;
        }
    }

    /**
     * @throws Exception
     */
    public function execute(): void
    {
        $argv = $_SERVER['argv'];
        if (!isset($argv[1])) {
            throw new Exception('Command not defined');
        }
        $signature = strtolower(trim($argv[1]));
        if (!array_key_exists($signature, $this->commands)) {
            throw new Exception('Command not exists');
        }

        $this->getClass($signature)->execute();
    }

    private function getClass(string $signature): Command
    {
        $class = $this->commands[$signature];
        return new $class;
    }

    /**
     * @return Command[]
     */
    public function getCommands(): array
    {
        return $this->commands;
    }

    private static $instance;

    final private function __construct()
    {
    }

    final private function __clone()
    {
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    final private function __wakeup()
    {
    }

    public static function getInstance(): CommandService
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}