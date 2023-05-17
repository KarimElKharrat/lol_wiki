<?php

define("PROJECT_ROOT_PATH", __DIR__ . '/');

if (file_exists(PROJECT_ROOT_PATH . '/vendor/autoload.php')) {
    require_once PROJECT_ROOT_PATH . '/vendor/autoload.php';
}

use Model\File;

try {
    File::includeTemplateFile('Header.php');
    File::includeTemplateFile(pathinfo(__FILE__)['filename'] . 'Container.php');
    File::includeTemplateFile('Footer.php');
} catch (\Throwable $th) {
    echo $th;
    // header("Location: http://localhost/integracion-dam/lol_wiki/error.php"); asd
    exit();
}

?>