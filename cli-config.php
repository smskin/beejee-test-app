<?php
/**
 * File for doctrine orm cli tools
 */
use App\Services\Framework\FrameworkService;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

define("BASE_PATH", dirname(__FILE__));

require_once 'vendor/autoload.php';

FrameworkService::getInstance()->boot();

$entityManager = FrameworkService::getInstance()->getDatabaseService()->getEntityManager();
return ConsoleRunner::createHelperSet($entityManager);