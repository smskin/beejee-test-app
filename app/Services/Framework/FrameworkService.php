<?php

namespace App\Services\Framework;

use App\Services\Framework\Contracts\ICommandService;
use App\Services\Framework\Contracts\IDatabaseService;
use App\Services\Framework\Contracts\IFrameworkService;
use App\Services\Framework\Contracts\IRouteService;
use App\Services\Framework\Contracts\IViewService;
use App\Services\Framework\Services\Command\CommandService;
use App\Services\Framework\Services\Database\DatabaseService;
use App\Services\Framework\Services\Route\RouteService;
use App\Services\Framework\Services\Helper\HelperService as HelperService;
use App\Services\Framework\Services\Session\SessionService;
use \App\Services\Framework\Services\View\ViewService as ViewService;
use Doctrine\ORM\ORMException;

class FrameworkService implements IFrameworkService
{
    /**
     * @var CommandService
     */
    protected $commandService;

    /**
     * @var DatabaseService
     */
    protected $databaseService;

    /**
     * @var RouteService
     */
    protected $routeService;

    /**
     * @var SessionService
     */
    protected $sessionService;

    /**
     * @var ViewService
     */
    protected $viewService;

    /**
     * @throws ORMException
     */
    public function boot(): void
    {
        $this->initHelperService();
        $this->initDatabaseService();
        $this->initSessionService();
        $this->initViewService();
        $this->initCommandService();
        $this->initRouteService();
    }

    private function initHelperService(): void
    {
        new HelperService();
    }

    private function initCommandService(): void
    {
        if (!is_cli()) {
            return;
        }

        $this->commandService = new CommandService();
    }

    private function initRouteService(): void
    {
        if (is_cli()) {
            return;
        }

        $this->routeService = new RouteService();
    }

    /**
     * @throws ORMException
     */
    private function initDatabaseService(): void
    {
        $this->databaseService = new DatabaseService();
    }

    private function initSessionService(): void
    {
        $this->sessionService = new SessionService();
    }

    private function initViewService(): void
    {
        if (is_cli()) {
            return;
        }

        $this->viewService = new ViewService();
    }

    public function getRouteService(): IRouteService
    {
        return $this->routeService;
    }

    public function getCommandService(): ICommandService
    {
        return $this->commandService;
    }

    public function getDatabaseService(): IDatabaseService
    {
        return $this->databaseService;
    }

    public function getViewService(): IViewService
    {
        return $this->viewService;
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

    public static function getInstance(): IFrameworkService
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}