<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-light">

    <?php
    
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/lol_wiki';
    $adminUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/lol_wiki/administrador';

    ?>
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a title="Inicio" class="nav-link text-primary" href="<?php echo $adminUrl . '/inicio.php'; ?>">Inicio</a>
                </li>
                <li class="nav-item">
                    <a title="Ligas" class="nav-link text-primary" href="<?php echo $adminUrl . '/secciones/Leagues.php'; ?>">Ligas</a>
                </li>
                <li class="nav-item">
                    <a title="Equipos" class="nav-link text-primary" href="<?php echo $adminUrl . '/secciones/Teams.php'; ?>">Equipos</a>
                </li>
                <li class="nav-item">
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
            <ul class="navbar-nav ml-auto">
                <li class="nav-item mr-5">
                    <a title="Lol wiki" class="nav-link text-success" href="<?php echo $url; ?>">Ver sitio web</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-danger" href="<?php echo $adminUrl . '/secciones/Logout.php'; ?>">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-3">
        <div class="row">