<?php

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

use Api\Controllers\UserController;

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$class = $uri[4];
$method = $uri[5];

if ((isset($class) && $class != 'user') || !isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$strClassName = 'Api\Controllers\\' . $class . 'Controller';
$objFeedController = new $strClassName();

$strMethodName = $method . 'Action';
$objFeedController->{$strMethodName}();
