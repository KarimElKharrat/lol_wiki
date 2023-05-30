<?php

if ($_SERVER['HTTP_HOST'] === 'localhost') {
    $url = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/';
} else {
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
}

// print('https://lolesportswiki.info/api/handler.php/' . $_GET['typePage'] . '/one?id=' . $_GET['id'] . '<br>');

$tableData = getApiCall('https://lolesportswiki.info/api/handler.php/' . $_GET['typePage'] . '/one?id=' . $_GET['id']);

/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Se ejecuta si estamos cargando a un JUGADOR, inicializa los datos.
 * ------------------------------------------------------------------------------------------------------------------------
 */
if ($_GET['typePage'] === 'player') {
    $alias = $tableData[0]['alias'];
    print('<div class="col-lg-12"><h1 class="mb-5">Detalles de ' . $alias . '</h1></div>');
    $nombreCompleto = $tableData[0]['nombre'] . ' "' . $tableData[0]['alias'] . '" ' . $tableData[0]['apellidos'];
    $imagen = $tableData[0]['image'];
    $rol_size = explode('x', $tableData[0]['rol_size']);

    $meses_ES = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
    $meses_EN = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
    $datos = [
        'Nombre' => $nombreCompleto,
        'Pais' => '<img src="' . $url . 'img/icons/16/' . $tableData[0]['iso'] . '.png"> ' . $tableData[0]['pais'],
        'Fecha Nac.' => str_replace($meses_EN, $meses_ES, date("d \d\\e F \d\\e\l Y", strtotime($tableData[0]['fecha_nacimiento']))),
        'Rol' => '<img class="img-fluid" src="' . $tableData[0]['rol_image'] . '" width="' . $rol_size[0] . '" height="' . $rol_size[1] . '"> ' . $tableData[0]['rol']
    ];

    $table = '<table style="font-size: 14px;table-layout: fixed;">';

    foreach ($datos as $key => $dato) {
        $table .= '<tr>';
        $table .= '<th>' . $key . '</th>';
        $table .= '<td style="padding: 8px;">' . $dato . '</td>';
        $table .= '</tr>';
    }

    $table .= '</table>';

    $card = '
    <div class="card" style="width: 20rem;">
        <div class="card-header text-center" style="height: 3rem;">
            <h5 class="card-title">' . $alias . '</h5>
        </div>
        <div class="card-header text-center bg-white ">
            <img src="' . $imagen . '" class="card-img-top" alt="Imagen">
        </div>
        <div class="card-body">
            ' . $table . '
        </div>
    </div>
    ';

    $teamHistory = '
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Equipo</th>
                <th>Liga</th>
                <th>Split</th>
                <th>Año</th>
            </tr>
        </thead>
        <tbody>
    ';

    $tableData = array_reverse($tableData);
    foreach ($tableData as $data) {
        $teamHistory .= '<tr>';
        $teamHistory .= '<td class="text-center" style="padding: 8px;"><a href="' . $url . 'detalles.php?typePage=team&id=' . $data['equipo_id'] . '"><img class="img-fluid" src="' . $data['team_image'] . '" width="35px" height="35px"></a></td>';
        $teamHistory .= '<td style="padding: 8px;"><a href="' . $url . 'detalles.php?typePage=splitleague&id=' . $data['split_league_id'] . '">' . $data['liga'] . '</a></td>';
        $teamHistory .= '<td style="padding: 8px;"><a href="' . $url . 'detalles.php?typePage=splitleague&id=' . $data['split_league_id'] . '">' . $data['split'] . '</a></td>';
        $teamHistory .= '<td style="padding: 8px;"><a href="' . $url . 'detalles.php?typePage=splitleague&id=' . $data['split_league_id'] . '">' . $data['año'] . '</a></td>';
        $teamHistory .= '</tr>';
    }

    $teamHistory .= '
        </tbody>
    </table>
    ';
}

/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Se ejecuta si estamos cargando a un EQUIPO, inicializa los datos.
 * ------------------------------------------------------------------------------------------------------------------------
 */
if ($_GET['typePage'] === 'team') {
    $nombre = $tableData[0]['nombre'];
    $tricode = $tableData[0]['tricode'];
    print('<div class="col-lg-12"><h1 class="mb-5">Detalles de ' . $nombre . '</h1></div>');
    $imagen = $tableData[0]['image'];

    $datos = [
        'Nombre' => $nombre,
        'Tricode' => $tricode,
        'Pais' => '<img src="' . $url . 'img/icons/16/' . $tableData[0]['iso'] . '.png"> ' . $tableData[0]['pais'],
    ];

    // DATA TABLE
    $dataTable = '<table style="font-size: 14px;table-layout: fixed;">';
    foreach ($datos as $key => $dato) {
        $dataTable .= '<tr>';
        $dataTable .= '<th>' . $key . '</th>';
        $dataTable .= '<td style="padding: 8px;">' . $dato . '</td>';
        $dataTable .= '</tr>';
    }
    $dataTable .= '</table>';

    $split_leagues = getApiCall('https://lolesportswiki.info/api/handler.php/splitleague/list?name=' . $tableData[0]['liga_abr']);

    $playersBySplit = [];

    foreach ($split_leagues as $split) {
        $playersBySplit[] = getApiCall('https://lolesportswiki.info/api/handler.php/player/byteamandsplit?teamId=' . $_GET['id'] . '&splitleagueId=' . $split['id']);
    }

    $playersBySplit = array_reverse($playersBySplit);

    $isAlive = !empty($playersBySplit[0]);

    // PLAYERS TABLE
    if ($isAlive) {
        $playersTable = '
        <div class="text-center">
            <h4>Roster actual</h4>
        </div>
        <table class="table table-bordered mb-5 w-75">
            <thead>
                <th>País</th>
                <th>Nombre completo</th>
                <th>Rol</th>
            </thead>
            <tbody>';
        foreach ($playersBySplit[0] as $player) {
            $nombreCompleto = $player['nombre'] . ' "' . $player['alias'] . '" ' . $player['apellidos'];
            $pais = '<img src="' . $url . 'img/icons/24/' . $player['iso'] . '.png">';
            $playersTable .= '<tr>';
            $playersTable .= '<td class="text-center">' . $pais . '</td>';
            $playersTable .= '<td><a href="' . $url . 'detalles.php?typePage=player&id=' . $player['id'] . '">' . $nombreCompleto . '</a></td>';
            $playersTable .= '<td><img class="img-fluid" src="' . $player['rol_image'] . '" width="25" height="25"> ' . $player['rol'] . '</td>';
            $playersTable .= '</tr>';
        }
        $playersTable .= '</tbody></table>';
    } else {
        $playersTable = '
        <div class="text-center">
            <h4>Roster actual</h4>
        </div>
        <div class="text-center text-danger mb-5">
            <h4>Este equipo se encuentra inactivo</h4>
        </div>';
    }

    $historyTable = '
    <div class="text-center">
        <h4>Historial de Rosters</h4>
    </div>
    <table class="table table-bordered mb-5">
        <thead>
            <th>Liga</th>
            <th>Año</th>
            <th>Jugadores</th>
        </thead>
        <tbody>
    ';
    foreach ($playersBySplit as $playerBySplit) {
        if (empty($playerBySplit)) continue;
        $historyTable .= '<tr>';
        $jugadores = '';
        foreach ($playerBySplit as $player) {
            $split = '<a href="' . $url . 'detalles.php?typePage=splitleague&id=' . $player['split_league_id'] . '">' . $player['liga_abr'] . ' de ' . $player['split'] . '</a>';
            $jugadores .= '<a class="mx-2" href="' . $url . 'detalles.php?typePage=player&id=' . $player['id'] . '"><img class="img-fluid" src="' . $player['rol_image'] . '" width="25" height="25"> ' . $player['alias'] . '</a>';
        }

        $historyTable .= '<td>' . $split . '</td>';
        $historyTable .= '<td>' . $player['año'] . '</td>';
        $historyTable .= '<td>' . $jugadores . '</td>';
        $historyTable .= '</tr>';
    }
    $historyTable .= '</tbody></table>';

    $card = '
    <div class="card" style="width: 22rem;">
        <div class="card-header text-center" style="height: 3rem;">
            <h5 class="card-title">' . $nombre . '</h5>
        </div>
        <div class="card-header text-center bg-white">
            <img src="' . $imagen . '" class="card-img-top" alt="Imagen">
        </div>
        <div class="card-body">
            ' . $dataTable . '
        </div>
    </div>
    ';
}

/**
 * ------------------------------------------------------------------------------------------------------------------------
 * Se ejecuta si estamos cargando a un SPLIT-LIGA, inicializa los datos.
 * ------------------------------------------------------------------------------------------------------------------------
 */
if ($_GET['typePage'] === 'splitleague') {
    $nombre = $tableData[0]['nombre'];
    $region = $tableData[0]['region'];
    $año = $tableData[0]['año'];
    $split = $tableData[0]['split'];
    $abrabiacion = $tableData[0]['liga_abr'];
    print('<div class="col-lg-12"><h1 class="mb-5">Detalles de la ' . $abrabiacion . ' de ' . $split . ' ' . $año . '</h1></div>');
    $imagen = $tableData[0]['image'];

    $regionesAbr = ['EU', 'KR', 'NA', 'CN', 'INT'];
    $regiones = ['Europa', 'Corea', 'Norte América', 'China', 'Internacional'];

    $datos = [
        'Nombre' => $nombre,
        'Region' => str_replace($regionesAbr, $regiones, $region),
        'Abr.' => $abrabiacion,
        'Año' => $año
    ];

    $table = '<table style="font-size: 14px;table-layout: fixed;">';
    foreach ($datos as $key => $dato) {
        $table .= '<tr>';
        $table .= '<th>' . $key . '</th>';
        $table .= '<td style="padding: 8px;">' . $dato . '</td>';
        $table .= '</tr>';
    }
    $table .= '</table>';

    $players = getApiCall('https://lolesportswiki.info/api/handler.php/team/bysplit?id=' . $_GET['id']);

    $card = '
    <div class="card" style="width: 24rem;">
        <div class="card-header text-center" style="height: 5rem;">
            <h5 class="card-title">' . $nombre . ' de ' . $split . '</h5>
        </div>
        <div class="card-header text-center bg-white">
            <img src="' . $imagen . '" class="card-img-top" alt="Imagen">
        </div>
        <div class="card-body">
            ' . $table . '
        </div>
    </div>
    ';
}

print('
<div class="col-lg-9">
    ' . ($teamHistory ?? '') . ($playersTable ?? '') . ($historyTable ?? '') . '
    <div class="jumbotron">
        <h1 class="display-3">LOL WIKI</h1>
        <p class="lead">Jumbo helper text</p>
        <hr class="my-2">
        <p>More info</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Jumbo action name</a>
        </p>
    </div>
</div>
<div class="col-lg-3">
    ' . ($card ?? '') . '
</div>
');


function getApiCall($url)
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $splits = str_replace('/var/www/vhosts/40650746.servicio-online.net/lolesportswiki.info/api', '', curl_exec($curl));
    $splits = json_decode($splits, true);

    curl_close($curl);

    return $splits;
}
