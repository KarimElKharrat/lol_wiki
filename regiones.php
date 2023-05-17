<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

use Model\File;

try {
    File::includeTemplateFile('Header.php');
    File::includeTemplateFile(pathinfo(__FILE__)['filename'] . 'Container.php');
    File::includeTemplateFile('Footer.php');
} catch (\Throwable $th) {
    echo $th;
    exit();
}
