<?php

if (!isset($_SESSION['isLogged'])) {
    $_SESSION['isLogged'] = false;
}

if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/';
    $adminUrl = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/administrador';
} else {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
    $adminUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/administrador';
}

?>

<!doctype html>
<html lang="en">

<head>
    <title>Lol wiki</title>
    <link rel="icon" type="image/x-icon" href="./img/icons/lolicon.png">
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

        .round {
            float: left;
        }

        .round.r-of-4 {}

        .round.r-of-2 {
            margin-top: 25px;
        }

        .bracket-game {
            max-width: 125px;
            margin: 10px 0;
        }

        .player {
            min-width: 100px;
            border: 1px solid #AAA;
            padding-left: 10px;
        }

        .player.top {
            border-radius: 3px 3px 0 0;
        }

        .player.bot {
            border-radius: 0 0 3px 3px;
        }

        .player .score {
            display: inline;
            float: right;
            border-left: 1px solid #AAA;
            padding-left: 10px;
            padding-right: 10px;
            background: #EEE;
        }

        .player.win {
            background-color: #B8F2B8;
        }

        .player.loss {
            background-color: #F2B8B8;
        }

        .connectors {
            float: left;
            min-width: 35px;
        }

        .connectors.r-of-2 .top-line {
            position: relative;
            top: 30px;
            width: 17px;
            border: 1px solid #AAA;
        }

        .connectors.r-of-2 .bottom-line {
            position: relative;
            top: 81px;
            width: 17px;
            border: 1px solid #AAA;
        }

        .connectors.r-of-2 .vert-line {
            position: relative;
            top: 26px;
            left: -16px;
            height: 55px;
            border-right: 2px solid #AAA;
        }

        .connectors.r-of-2 .next-line {
            position: relative;
            top: -4px;
            left: 17px;
            width: 17px;
            border: 1px solid #AAA;
        }

        .clear {
            clear: both;
        }

        /* Style the tab */
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons that are used to open the tab content */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }

        .dropdown-menu-center {
            right: auto;
            left: 50%;
            -webkit-transform: translate(-50%, 0);
            -o-transform: translate(-50%, 0);
            transform: translate(-50%, 0);
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-light bg-light" style="font-size: 20px !important;">

        <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
            <a class="navbar-brand ml-auto mr-5" href="./index.php">Lol Wiki</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".dual-collapse2">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>

        <div class="mx-auto order-0">

            <ul class="navbar-nav mr-auto">
                <li class="nav-item mx-2">
                    <a class="nav-link" href="<?php echo './ligas.php'; ?>">Ligas</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="<?php echo './equipos.php'; ?>">Equipos</a>
                </li>
                <li class="nav-item mx-2">
                    <a class="nav-link" href="<?php echo './jugadores.php'; ?>">Jugadores</a>
                </li>
            </ul>
        </div>

        <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">

            <nav class="navbar navbar-light bg-light ml-5">
                <div class="container-fluid">
                    <form class="d-flex input-group w-auto" method="post" action="busqueda.php">
                        <input type="text" class="form-control rounded" placeholder="Buscar" name="search"/>
                        <input type="submit" class="input-group-text border-0" name="submit" value="Buscar" />
                    </form>
                </div>
            </nav>
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <?php

                    if (true === $_SESSION['isLogged']) {
                        echo '
                        <div class="dropdown open">
                            <button class="btn btn-success dropdown-toggle" type="button" id="triggerId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i> ' . $_SESSION['username'] . '
                            </button>
                            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="triggerId">
                                <a class="dropdown-item text-success" href="administrador/inicio.php"><i class="fa fa-cog" aria-hidden="true"></i> Panel de Admin</a>
                                <a class="dropdown-item text-danger" href="' . $adminUrl . '/secciones/Logout.php' . '"><i class="fa fa-sign-out" aria-hidden="true"></i> Cerrar Sesión</a>
                            </div>
                        </div>
                        ';
                    } else {
                        echo '
                        <a class="btn btn-info" href="administrador/index.php" title="Acceder al panel de administrador">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </a>
                        ';

                    } ?>
                </li>
            </ul>
        </div>


    </nav>

    <nav class="navbar navbar-light bg-light">

    </nav>

    <!-- <div class="container mt-3"> -->
    <div class="container mt-3">
        <div class="row">