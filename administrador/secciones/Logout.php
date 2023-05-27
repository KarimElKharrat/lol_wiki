<?php

if(!isset($_SESSION)) {
    session_start();
}

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/';
} else {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
}

$_SESSION['isLogged'] = false;

?>
<!doctype html>
<html lang="en">

<head>
    <title>Panel de control - Lol wiki</title>
    <link rel="icon" type="image/x-icon" href="<?php echo $url; ?>img/icons/lolicon.png">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        #xd {
            margin: 0;
            position: absolute;
            top: 40%;
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }

        footer {
            margin-top: auto;
            min-height: 50px;
            text-align: center;
            padding: 3px;
        }
    </style>
</head>

<body class="bg-light">

    <div class="col-md-12 text-center" id="xd">

        <div class="jumbotron bg-light mt-5">
            <h1 class="display-3">Sesion cerrada.</h1>
            <p class="lead">
                <br>
            </p>
            <a class="btn btn-primary btn-lg" href="<?php echo $url; ?>" role="button">Ir a la página web</a>
        </div>

    </div>

    <?php

    File::includeTemplateFile('adminFooter.php');
