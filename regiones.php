<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

try {
    include(PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates/Header.php');
    include(PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates/containers/' .pathinfo(__FILE__)['filename'] . 'Container.php');
    include(PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates/Footer.php');
} catch (\Throwable $th) {
    echo $th;
}