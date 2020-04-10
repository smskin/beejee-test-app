<?php

namespace App\Services\Framework\Contracts;

use App\Services\Framework\Services\Helper\HelperService;

interface IHelperService
{
    public function boot(): void;

    public static function getInstance(): HelperService;
}