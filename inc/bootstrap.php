<?php

header("Cache-Control: no cache");
session_cache_limiter("private_no_expire");

if(!isset($_SESSION)) {
    session_start();
}

/**
 * Script que se encarga de inicializar lo básico
 */
define("PROJECT_ROOT_PATH", dirname(__DIR__));

if (file_exists(PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php')) {
    require_once PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
}

require_once 'config.php';
require_once PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR. 'model' . DIRECTORY_SEPARATOR . 'File.php';
