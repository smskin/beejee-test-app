<?php

use App\Services\Framework\FrameworkService as FrameworkService;

if (!function_exists('app')) {
    function app(): FrameworkService
    {
        return FrameworkService::getInstance();
    }
}