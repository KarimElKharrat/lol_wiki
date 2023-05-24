<?php

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

File::includeTemplateFile('adminHeader.php');

$_SESSION['type'] = 'players';

File::includeTemplateFile('adminTable.php');

File::includeTemplateFile('adminFooter.php');