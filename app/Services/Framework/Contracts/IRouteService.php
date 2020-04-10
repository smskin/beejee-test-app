<?php

namespace App\Services\Framework\Contracts;

use App\Services\Framework\Services\Route\RouteService;
use Bramus\Router\Router;

interface IRouteService
{
    public function boot(): void;

    public function getRouter(): Router;

    public static function getInstance(): RouteService;
}