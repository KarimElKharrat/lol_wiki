<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

$class = $uri[3];
$method = $uri[4];

$allowedClasses = ['user', 'league', 'player', 'team'];

if ((isset($class) && !in_array($class, $allowedClasses)) || !isset($uri[3])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$className = ucfirst($class) . 'Controller';
include(__DIR__ . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR . $className . '.php');

switch ($className) {
    case 'UserController':
        $objFeedController = new UserController();
        break;
    case 'TeamController':
        $objFeedController = new TeamController();
        break;
    case 'PlayerController':
        $objFeedController = new PlayerController();
        break;
    case 'LeagueController':
        $objFeedController = new LeagueController();
        break;

    default:
        header("HTTP/1.1 404 Not Found");
        exit();
        break;
}


$strMethodName = $method . 'Action';
$objFeedController->{$strMethodName}();
