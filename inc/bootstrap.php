<?php

define("PROJECT_ROOT_PATH", __DIR__ . "/../");

if (file_exists(PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php')) {
    require_once PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
}

use Inc\Config;

Config::init();

// include the base controller file 
// require_once PROJECT_ROOT_PATH . "/Controller/Api/BaseController.php";
// include the use model file 
// require_once PROJECT_ROOT_PATH . "/Model/UserModel.php";