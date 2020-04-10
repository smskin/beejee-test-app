<?php

if (!function_exists('base_path')) {
    function base_path()
    {
        return BASE_PATH;
    }
}

if (!function_exists('app_path')) {
    function app_path(string $path = '')
    {
        return base_path() . DIRECTORY_SEPARATOR . 'app' . ($path ? DIRECTORY_SEPARATOR . ltrim($path, DIRECTORY_SEPARATOR) : $path);
    }
}