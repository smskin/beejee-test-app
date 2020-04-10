<?php

namespace App\Services\Framework\Contracts;

use SmartyException;

interface IViewService
{
    public function boot(): void;

    /**
     * @param string $template
     * @param array $variables
     * @return void
     * @throws SmartyException
     */
    public function render(string $template, array $variables = []): void;
}