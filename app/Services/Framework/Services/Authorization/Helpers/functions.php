<?php

use App\Services\Framework\Contracts\IAuthorizationService;

if (!function_exists('auth')){
    function auth(): IAuthorizationService
    {
        return app()->getAuthorizationService();
    }
}