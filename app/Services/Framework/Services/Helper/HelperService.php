<?php

namespace App\Services\Framework\Services\Helper;

use App\Services\Framework\Contracts\IHelperService;

class HelperService implements IHelperService
{
    public function boot(): void
    {
        foreach (glob(__DIR__ . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . '*.php') as $file) {
            /** @noinspection PhpIncludeInspection */
            require_once($file);
        }
        foreach (glob(app_path() . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . '*.php') as $file) {
            /** @noinspection PhpIncludeInspection */
            require_once($file);
        }
    }

    private static $instance;

    final private function __construct()
    {
    }

    final private function __clone()
    {
    }

    /** @noinspection PhpUnusedPrivateMethodInspection */
    final private function __wakeup()
    {
    }

    public static function getInstance(): HelperService
    {
        if (is_null(self::$instance)) {
            self::$instance = new static();
        }
        return self::$instance;
    }
}