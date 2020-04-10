<?php

namespace App\Services\Framework\Contracts;

use Bramus\Router\Router;

interface IRouteService
{
    public function getRouter(): Router;
}