<?php

try {
    if ($_SERVER['HTTP_HOST'] === 'localhost') {
        $add = '/lolesportswiki';
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/';
        $adminUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/administrador';
    } else {
        $add = '';
        $url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
        $adminUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/administrador';
    }

    if (!isset($_SESSION['isLogged'])) {
        $_SESSION['isLogged'] = false;
    }

    if (false === $_SESSION['isLogged']) {
        header('Location: ' . $url . 'administrador/index.php');
    }

    if (isset($_COOKIE['deleteId']) && $_COOKIE['deleteId'] != -1) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://lolesportswiki.info/api/handler.php/' . $_SESSION['type'] . '/delete?id=' . $_COOKIE['deleteId'],
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $users = str_replace('/var/www/vhosts/40650746.servicio-online.net/lolesportswiki.info/api', '', curl_exec($curl));
        curl_close($curl);
        setcookie('deleteId', -1, 0, $add . '/administrador');
    }
} catch (\Throwable $th) {
    throw new Exception($th->getMessage());
}

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

        .dropdown-menu-center {
            right: auto;
            left: 50%;
            -webkit-transform: translate(-50%, 0);
            -o-transform: translate(-50%, 0);
            transform: translate(-50%, 0);
        }

        #userDropdown {
            margin-right: 10em;
        }

        .my-custom-scrollbar {
            position: relative;
            max-height: 600px;
            overflow: auto;
        }

        .table-wrapper-scroll-y {
            display: block;
        }

        .table>tbody>tr>td {
            vertical-align: middle;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-light bg-light pb-0">
        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2 align-items-center">
            <ul class="navbar-nav mr-auto ml-5">
                <li class="nav-item active">
                    <a title="Inicio" class="nav-link text-primary" href="<?php echo $adminUrl . '/inicio.php'; ?>">
                        <h5>Inicio</h4>
                    </a>
                </li>
                <li class="nav-item ml-3">
                    <a title="Ligas" class="nav-link text-primary" href="<?php echo $adminUrl . '/secciones/League.php'; ?>">Ligas</a>
                </li>
                <li class="nav-item ml-3">
                    <a title="Equipos" class="nav-link text-primary" href="<?php echo $adminUrl . '/secciones/Teams.php'; ?>">Equipos</a>
                </li>
                <li class="nav-item ml-3">
                    <a title="Jugadores" class="nav-link text-primary" href="<?php echo $adminUrl . '/secciones/Players.php'; ?>">Jugadores</a>
                </li>
                <!-- <li class="nav-item ml-3">
                    <a title="Entrenadores" class="nav-link text-primary" href="<?php echo $adminUrl . '/secciones/Coaches.php'; ?>">Entrenadores</a>
                </li> -->
            </ul>
        </div>
        <div class="mx-auto order-0">
            <label class="navbar-brand mx-auto">Administrador</label>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
            <ul class="navbar-nav ml-auto" id="userDropdown">
                <li class="nav-item">
                    <div class="dropdown open">
                        <button class="btn btn-success dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-user" aria-hidden="true"></i> <?php echo $_SESSION['username'] ?>
                        </button>
                        <div class="dropdown-menu dropdown-menu-center" aria-labelledby="triggerId">
                            <a class="dropdown-item text-success" href="<?php echo $url; ?>"><i class="fa fa-user" aria-hidden="true"></i> Ver Sitio Web</a>
                            <a class="dropdown-item text-danger" href="<?php echo $adminUrl . '/secciones/Logout.php'; ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesión</a>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container px-5" style="max-width: 110%;">
        <hr class="my-2">
        <br>
        <div class="row mt-3">