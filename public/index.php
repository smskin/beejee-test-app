<?php

use App\Services\Framework\FrameworkService as FrameworkService;

define("BASE_PATH", dirname( dirname(__FILE__)));

require_once '../vendor/autoload.php';

FrameworkService::getInstance()->boot();