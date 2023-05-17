<?php

require __DIR__ . "/inc/bootstrap.php";

use Model\File;

try {
    File::includeTemplateFile('Header.php');
    File::includeTemplateFile(pathinfo(__FILE__)['filename'] . 'Container.php');
    File::includeTemplateFile('Footer.php');
} catch (\Throwable $th) {
    echo $th;
}

?>