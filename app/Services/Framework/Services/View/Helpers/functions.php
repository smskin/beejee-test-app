<?php

use App\Services\Framework\Services\View\ViewService;

if (!function_exists('render')){
    /**
     * @param string $template
     * @param array $variables
     * @return void
     * @noinspection PhpDocMissingThrowsInspection
     */
    function render(string $template, array $variables = []): void
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        ViewService::getInstance()->render($template, $variables);
    }
}