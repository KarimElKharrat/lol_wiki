<?php
print('<div class="mx-auto h3">Equipos</div></div>');

$output = '
    <div class="row my-3 text-left">
        <ul class="list-group col-md-12">
';

/**
 * Recoge los datos de la api sólo cuando entras por primera vez a ésta página.
 */
if (!isset($_POST['adelante']) && !isset($_POST['atras'])) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://lolesportswiki.info/api/handler.php/team/list',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $tableData = str_replace('/var/www/vhosts/40650746.servicio-online.net/lolesportswiki.info/api', '', curl_exec($curl));
    $tableData = json_decode($tableData, true);

    curl_close($curl);

    $_SESSION['pagina'] = 0;
    $_SESSION['totalPaginas'] = ceil(count($tableData) / 10);
    $_SESSION['tableData'] = [];

    if (empty($tableData)) {
        $output .= '
    <li href="#" class="list-group-item">
        No hay resultados...
    </li>';
    } else {
        for ($i = 0; $i < $_SESSION['totalPaginas']; $i++) {
            $_SESSION['tableData'][] = array_splice($tableData, 0, 10);
        }
        changePage(1);
    }
}

/**
 * Cambia la página cuando le das hacia delante.
 */
if (isset($_POST['adelante'])) {
    changePage(1);
}

/**
 * Cambia la página cuando le das hacia atrás.
 */
if (isset($_POST['atras'])) {
    changePage(-1);
}

$output .= loadSearchPage();

$output .= '</ul></div>';

$outputPagina =
    '
<form method="post" class="text-right" id="page-counter">
    <button class="btn" type="submit" name="atras" ' . ((0.0 === $_SESSION['totalPaginas'] || 1 === $_SESSION['pagina']) ? 'disabled="disabled"' : '') . '>
        <i class="fa fa-backward" aria-hidden="true"></i>
    </button>
    Página ' . $_SESSION['pagina'] . ' de ' . $_SESSION['totalPaginas'] . '
    <button class="btn" type="submit" name="adelante" ' . ((0.0 === $_SESSION['totalPaginas'] || $_SESSION['pagina'] == $_SESSION['totalPaginas']) ? 'disabled="disabled"' : '') . '>
        <i class="fa fa-forward" aria-hidden="true"></i>
    </button>
</form>
';

print($outputPagina . $output . $outputPagina);

/**
 * Cambia la página según el valor que se le pase.
 */
function changePage($num)
{
    $pag = $_SESSION['pagina'] += $num;
    if ($pag < 1) {
        $_SESSION['pagina'] = 1;
    } else if ($pag > $_SESSION['totalPaginas']) {
        $_SESSION['pagina'] = $_SESSION['totalPaginas'];
    }
}

/**
 * Carga la página actual, ésta se guarda en $_SESSION['pagina'].
 */
function loadSearchPage()
{
    if ($_SERVER['HTTP_HOST'] === 'localhost') {
        $url = 'http://' . $_SERVER['HTTP_HOST'] . '/lolesportswiki/';
    } else {
        $url = 'https://' . $_SERVER['HTTP_HOST'] . '/';
    }

    $output = '';

    if (count($_SESSION['tableData']) > 0) {

        $tableData = $_SESSION['tableData'][$_SESSION['pagina'] - 1];

        foreach ($tableData as $data) {
            $nombre = $data['nombre'];
            $alias = (isset($data['alias']) && $data['alias'] !== '') ? ' "' . $data['alias'] . '" ' : '';
            $apellidos = $data['apellidos'] ?? '';
            $year = $data['año'] ?? '';
            $split = $data['split'] ?? '';
            $liga_abr = (isset($data['liga_abr']) && $data['liga_abr'] !== '') ? ' (' . $data['liga_abr'] . ') ' : '';
            $imagen = $data['image'];
            $image_size = explode('x', $data['image_size']);

            if (isset($imagen) && $imagen !== '') {
                $output .= '
                <a href="' . $url . 'detalles.php?typePage=' . $data['type'] . '&id=' . $data['id'] . '" class="list-group-item">
                    <div class="media align-items-center">
                        <div class="text-center" style="width: 150px;height: 100px;display: flex;align-items: center;justify-content: center;">
                            <img class="img-fluid" src="' . $imagen . '" width="' . ((int) ($image_size[0]/2)) . '" height="' . ((int) ($image_size[1]/2)) . '">
                        </div>
                        <div class="media-body ml-3">
                            <h5 class="mt-0">' . $year . ' ' . $split . $liga_abr . $nombre . $alias . $apellidos . '</h5>
                        </div>
                    </div>
                </a>';
            } else {
                $output .= '
                <a href="' . $url . 'detalles.php" class="list-group-item">
                    <div class="media">
                        <div class="media-body ml-3">
                        <h5 class="mt-0">' . ucfirst($imagen ?? '') . $nombre . ' ' . $alias . ' ' . $apellidos . '</h5>
                        </div>
                    </div>
                </a>';
            }
        }
    }

    return $output;
}
