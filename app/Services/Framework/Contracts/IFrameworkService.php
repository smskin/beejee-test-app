<?php

namespace App\Services\Framework\Contracts;

use App\Services\Framework\FrameworkService;
use App\Services\Framework\Services\Command\CommandService as CommandService;
use App\Services\Framework\Services\Route\RouteService as RouteService;

interface IFrameworkService
{
    public function boot(): void;

    public static function getInstance(): FrameworkService;

    public function getRouteService(): RouteService;

    public function getCommandService(): CommandService;
}