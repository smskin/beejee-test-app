<?php

namespace App\Services\Framework\Contracts;

interface IFrameworkService
{
    public function boot(): void;

    public static function getInstance(): IFrameworkService;

    public function getRouteService(): IRouteService;

    public function getCommandService(): ICommandService;

    public function getDatabaseService(): IDatabaseService;

    public function getViewService(): IViewService;
}