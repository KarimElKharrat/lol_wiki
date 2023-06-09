<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/';
    $adminUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/administrador';
} else {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
    $adminUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/administrador';
}

if (!isset($_SESSION['isLogged'])) {
    $_SESSION['isLogged'] = false;
}

if (true === $_SESSION['isLogged']) {
    header('Location: ' . $url . 'administrador/inicio.php');
}

$txt = '<!doctype html>
<html lang="en">

<head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="bg-light">
    <br><br><br><br><br><br>
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Usuario:</label> <label class="text-danger">*</label>
                                <input type="text" name="nombre" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Usuario">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Contraseña:</label> <label class="text-danger">*</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Contraseña">
                            </div>
                            <div class="row mx-md-n5">
                                <div class="col px-md-5">
                                    <a type="button" class="btn btn-warning mt-3" href="' . $url . '"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
                                </div>
                                <div class="col px-md-5">
                                    <button type="submit" class="btn btn-success mt-3">Acceder <i class="fa fa-sign-in" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div id="error" class="alert alert-danger mt-3';

if ($_POST) {

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://lolesportswiki.info/api/handler.php/user/list',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $users = str_replace('/var/www/vhosts/40650746.servicio-online.net/lolesportswiki.info/api', '', curl_exec($curl));
    $users = json_decode($users, true);
    curl_close($curl);

    $nombre = $_POST["nombre"];
    $password = $_POST["password"];

    if (!empty($users)) {
        foreach ($users as $user) {
            if ($user['nombre'] === $nombre && base64_decode($user['password']) === $password) {
                $_SESSION['isLogged'] = true;
                $_SESSION['username'] = $nombre;

                header('Location: inicio.php');
            }
        }
    }
} else {
    $txt .= ' d-none';
}

$txt .= '" role="alert">
                Nombre de usuario o contraseña incorrectos!
            </div>
        </div>
    </div>

</body>

</html>';

echo $txt;
