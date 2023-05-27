<?php

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

if(!isset($_SESSION)) {
    session_start();
}

$_SESSION['type'] = 'player';
$_SESSION['name'] = 'Jugadores';

File::includeTemplateFile('adminHeader.php');

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://lolesportswiki.info/api/handler.php/' . $_SESSION['type'] . '/list',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$tableData = str_replace('/var/www/vhosts/40650746.servicio-online.net/lolesportswiki.info/api', '', curl_exec($curl));
$tableData = json_decode($tableData, true);

curl_close($curl);

$_SESSION['tableData'] = $tableData;

File::includeTemplateFile('adminTable.php');

File::includeTemplateFile('adminFooter.php');