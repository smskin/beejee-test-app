<?php

namespace App\Services\Framework\Contracts;

use SmartyException;

interface IViewService
{
    /**
     * @param string $template
     * @param array $variables
     * @return void
     * @throws SmartyException
     */
    public function render(string $template, array $variables = []): void;
}