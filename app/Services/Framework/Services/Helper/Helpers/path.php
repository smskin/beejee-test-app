<?php

if (!function_exists('base_path')) {
    function base_path()
    {
        return dirname(__FILE__,7);
    }
}

if (!function_exists('app_path')) {
    function app_path(string $path = '')
    {
        return base_path() . DIRECTORY_SEPARATOR . 'app' . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}