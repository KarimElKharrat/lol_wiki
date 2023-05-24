<?php

// TODO cambiar cuando se suba
$url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
$adminUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/administrador';
// $url = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/';
// $adminUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/administrador';

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

        footer {
            margin-top: auto;
            min-height: 50px;
            text-align: center;
            padding: 3px;
        }
    </style>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2 align-items-center">
            <ul class="navbar-nav mr-auto ml-5">
                <li class="nav-item active">
                    <a title="Inicio" class="nav-link text-primary" href="<?php echo $adminUrl . '/inicio.php'; ?>">
                        <h5>Inicio</h4>
                    </a>
                </li>
                <li class="nav-item ml-3">
                    <a title="Ligas" class="nav-link text-primary" href="<?php echo $adminUrl . '/secciones/Leagues.php'; ?>">Ligas</a>
                </li>
                <li class="nav-item ml-3">
                    <a title="Equipos" class="nav-link text-primary" href="<?php echo $adminUrl . '/secciones/Teams.php'; ?>">Equipos</a>
                </li>
                <li class="nav-item ml-3">
                    <a title="Jugadores" class="nav-link text-primary" href="<?php echo $adminUrl . '/secciones/Players.php'; ?>">Jugadores</a>
                </li>
            </ul>
        </div>
        <div class="mx-auto order-0">
            <label class="navbar-brand mx-auto">Administrador</label>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto mr-5">

                <li class="nav-item mr-5">
                    <a title="Lol wiki" class="nav-link text-success" href="<?php echo $url; ?>"><i class="fa fa-home" aria-hidden="true"></i> Ver sitio web</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="<?php echo $adminUrl . '/secciones/Logout.php'; ?>"><i class="fa fa-times" aria-hidden="true"></i> Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <div class="container mt-3">
        <div class="row">