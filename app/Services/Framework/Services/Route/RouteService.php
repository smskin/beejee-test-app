<?php

namespace App\Services\Framework\Services\Route;

use App\Services\Framework\Contracts\IRouteService;
use Bramus\Router\Router;

class RouteService implements IRouteService
{
    /**
     * @var Router
     */
    protected $router;

    public function boot(): void
    {
        $this->initHelpers();
        $this->initRouter();
    }

    private function initRouter(): void
    {
        $this->router = new Router();
        /** @noinspection PhpIncludeInspection */
        require_once app_path('routes.php');

        $this->router->setNamespace('App\\Http\\Controllers');
        $this->router->run();
    }

    private function initHelpers(): void
    {
        require_once 'Helpers/functions.php';
    }

    public function getRouter(): Router
    {
        return $this->router;
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

    public static function getInstance(): RouteService
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}