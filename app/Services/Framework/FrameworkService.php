<?php

namespace App\Services\Framework;

use App\Services\Framework\Contracts\IFrameworkService;
use App\Services\Framework\Services\Command\CommandService as CommandService;
use App\Services\Framework\Services\Route\RouteService as RouteService;
use App\Services\Framework\Services\Helper\HelperService as HelperService;
use \App\Services\Framework\Services\View\ViewService as ViewService;

class FrameworkService implements IFrameworkService
{
    public function boot(): void
    {
        $this->initHelperService();
        $this->initViewService();
        $this->initCommandService();
        $this->initRouteService();
    }

    private function initHelperService(): void
    {
        HelperService::getInstance()->boot();
    }

    private function initCommandService(): void
    {
        if (!is_cli()) {
            return;
        }

        CommandService::getInstance()->boot();
    }

    private function initRouteService(): void
    {
        if (is_cli()) {
            return;
        }

        RouteService::getInstance()->boot();
    }

    private function initViewService(): void
    {
        if (is_cli()) {
            return;
        }

        ViewService::getInstance()->boot();
    }

    public function getRouteService(): RouteService
    {
        return RouteService::getInstance();
    }

    public function getCommandService(): CommandService
    {
        return CommandService::getInstance();
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

    public static function getInstance(): FrameworkService
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}