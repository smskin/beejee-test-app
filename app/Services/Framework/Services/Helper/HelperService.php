<?php

namespace App\Services\Framework\Services\Helper;

use App\Services\Framework\Contracts\IHelperService;

class HelperService implements IHelperService
{
    public function __construct(){
        foreach (glob(__DIR__ . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . '*.php') as $file) {
            /** @noinspection PhpIncludeInspection */
            require_once($file);
        }
        foreach (glob(app_path() . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . '*.php') as $file) {
            /** @noinspection PhpIncludeInspection */
            require_once($file);
        }
    }
}