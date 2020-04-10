<?php

if (!function_exists('render_view')){
    /**
     * @param string $template
     * @param array $variables
     * @return void
     * @noinspection PhpDocMissingThrowsInspection
     */
    function render_view(string $template, array $variables = []): void
    {
        $viewService = app()->getViewService();
        /** @noinspection PhpUnhandledExceptionInspection */
        $viewService->render($template, $variables);
    }
}

if (!function_exists('render_json')){
    function render_json($obj){
        header("Content-type: application/json");
        print_r(json_encode($obj));
    }
}

if (!function_exists('render_exception')){
    function render_exception(Exception $exception){
        http_response_code($exception->getCode() ? $exception->getCode() : 500);
        print_r($exception->getMessage());
    }
}