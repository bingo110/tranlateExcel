<?php

/**
 * Bootstrap for PhpSpreadsheet classes.
 */

define('ROOT_PATH', __DIR__.'/../');
require_once __DIR__ .'/api/baidu/baidu_transapi.php';

$paths = [
    __DIR__ . '/../vendor/autoload.php', // In case PhpSpreadsheet is cloned directly
];

foreach ($paths as $path) {
    if (file_exists($path)) {
        require_once $path;
        return;
    }
}
throw new \Exception('Composer autoloader could not be found. Install dependencies with `composer install` and try again.');
