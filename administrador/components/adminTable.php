<?php

$rows = $_SESSION['tableData'];
$columns = $rows[0];

function add()
{
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://lolesportswiki.info/api/handler.php/' . $_SESSION['type'] . '/add',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_CUSTOMREQUEST => 'POST',
    ));

    $users = str_replace('/var/www/vhosts/40650746.servicio-online.net/lolesportswiki.info/api', '', curl_exec($curl));
    $users = json_decode($users, true);
    curl_close($curl);
}

echo '<div class="mx-auto h3">Tabla de ' . $_SESSION['name'] . '</div>
<div class="col-md-12 text-center mt-3">
<!--<button title="Añadir" type="button" class="btn btn-success float-left mx-1 mb-3" style="margin: -0.25em;" onclick="addRegistro()"><i class="fa fa-plus" aria-hidden="true"></i> Añadir registro</button>
<div class="mb-3">
<br><br>
</div>-->
<div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table class="table table-hover table-bordered table-striped mb-0">
        <thead>
            <tr>';

foreach ($columns as $key => $column) {
    if ($key === 'image_size' || $key === 'rol_size' || $key === 'type') {
        continue;
    }

    echo '<th scope="col">' . ucfirst($key) . '</th>';
}

echo '<th scope="col">Acciones</th>';

echo '
            </tr>
        </thead>
        <tbody>';

foreach ($rows as $row) {
    echo '<tr>';
    $image_size = explode('x', $row['image_size'] ?? '65x65');
    $rol_size = explode('x', $row['rol_size'] ?? '20x20');
    foreach ($row as $key => $value) {
        if ($key === 'image_size' || $key === 'rol_size' || $key === 'type') continue;
        if (($key === 'icono' || $key === 'image') && isset($value) && $value !== '') {
            echo '<td><img class="img-fluid" src="' . $value . '" width="' . ((int) ($image_size[0]/2)) . '" height="' . ((int) ($image_size[1]/2)) . '"></td>';
        } else if (($key === 'rol_image') && isset($value) && $value !== '') {
            echo '<td><img class="img-fluid" src="' . $value . '" width="' . $rol_size[0] . '" height="' . $rol_size[1] . '"></td>';
        } else {
            echo '<td>' . ucfirst($value ?? '') . '</td>';
        }
    }
    echo '<td class="text-center">
    <button title="Eliminar" type="button" class="btn btn-danger mx-1" style="margin: -0.25em;" onclick="eliminarRegistro(' . $row['id'] . ')"><i class="fa fa-trash" aria-hidden="true"></i></button>
    </td>';
    echo '</tr>';
}

echo '
        </tbody>
    </table>
</div>
</div>';

?>

<script>
    function addRegistro() {
        <?php add(); ?>
    }

    function eliminarRegistro(deleteId) {
        path = '/administrador';
        if (window.location.hostname === 'localhost') {
            path = '/lolesportswiki' + path;
        }
        document.cookie = 'deleteId=' + deleteId + ';path=' + path;
        location.reload();
    }
</script>