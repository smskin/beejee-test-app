<?php

if (!function_exists('render')){
    /**
     * @param string $template
     * @param array $variables
     * @return void
     * @noinspection PhpDocMissingThrowsInspection
     */
    function render(string $template, array $variables = []): void
    {
        $viewService = app()->getViewService();
        /** @noinspection PhpUnhandledExceptionInspection */
        $viewService->render($template, $variables);
    }
}