<?php
require_once __DIR__.'/Helpers/instance.php';
require_once __DIR__.'/Helpers/path.php';
require_once __DIR__.'/Helpers/utilities.php';

foreach (glob(app_path('/Helpers/*.php')) as $file) {
    /** @noinspection PhpIncludeInspection */
    require_once($file);
}