<?php

if (!function_exists('base_path')) {
    function base_path()
    {
        return dirname(__FILE__,7);
    }
}

if (!function_exists('fix_path')){
    function fix_path(string $path = ''): string
    {
        /** @noinspection RegExpRedundantEscape */
        return preg_replace('/([\\]|[\/])/i', DIRECTORY_SEPARATOR, $path);
    }
}

if (!function_exists('app_path')) {
    function app_path(string $path = '')
    {
        $result = base_path(). '/app/' . ($path ? ltrim($path, '/') : $path);
        return fix_path($result);
    }
}