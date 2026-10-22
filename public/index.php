<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

$scriptName = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '');
$requestUri = $_SERVER['REQUEST_URI'] ?? '/';
if (str_contains($scriptName, '/public/index.php') && ! str_contains($requestUri, '/public/')) {
    $basePath = rtrim(str_replace('/public/index.php', '', $scriptName), '/');
    if ($basePath !== '' && str_starts_with($requestUri, $basePath)) {
        $_SERVER['SCRIPT_NAME'] = $basePath.'/index.php';
        $_SERVER['PHP_SELF'] = $basePath.'/index.php';
    }
}

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
