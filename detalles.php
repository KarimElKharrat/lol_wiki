<?php

require __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/';
} else {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
}

if (!(isset($_GET['typePage']) && isset($_GET['id']))) {
    header('Location: ' . $url);
    exit();
}

/**
 * Incluimos todos los componentes
*/
try {
    include(PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates/Header.php');
    include(PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates/containers/' .pathinfo(__FILE__)['filename'] . 'Container.php');
    include(PROJECT_ROOT_PATH . DIRECTORY_SEPARATOR . 'templates/Footer.php');
} catch (\Throwable $th) {
    echo $th;
}