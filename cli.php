<?php

use App\Services\Framework\FrameworkService;

define("BASE_PATH", dirname(__FILE__));

require_once 'vendor/autoload.php';

FrameworkService::getInstance()->boot();
FrameworkService::getInstance()->getCommandService()->execute();