<?php

use App\Services\Framework\FrameworkService as FrameworkService;

define("BASE_PATH", dirname(__FILE__));

require_once 'vendor/autoload.php';

FrameworkService::getInstance()->boot();
/** @noinspection PhpUnhandledExceptionInspection */
FrameworkService::getInstance()->getCommandService()->execute();