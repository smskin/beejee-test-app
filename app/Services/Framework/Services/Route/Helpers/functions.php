<?php

use Bramus\Router\Router;

if (!function_exists('router')) {
    function router(): Router
    {
        return app()->getRouteService()->getRouter();
    }
}

if (!function_exists('abort')) {
    function abort(int $code): void
    {
        http_response_code($code);
        die();
    }
}