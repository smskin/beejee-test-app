<?php

namespace App\Services\Framework\Contracts;

use Bramus\Router\Router;

interface IRouteService
{
    public function boot(): void;
    public function getRouter(): Router;
}