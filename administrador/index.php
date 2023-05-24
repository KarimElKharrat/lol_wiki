<?php

$txt = '<!doctype html>
<html lang="en">

<head>
    <title>Administrador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
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
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-3">Aceptar</button>
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
?>