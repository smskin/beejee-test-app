<?php

use App\Services\Framework\Contracts\IFrameworkService;
use App\Services\Framework\FrameworkService as FrameworkService;

if (!function_exists('app')) {
    function app(): IFrameworkService
    {
        return FrameworkService::getInstance();
    }
}