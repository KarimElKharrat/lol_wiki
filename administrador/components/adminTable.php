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
<div class="col-md-12 mt-3">
<div class="table-wrapper-scroll-y my-custom-scrollbar">
    <table class="table table-hover table-bordered table-striped mb-0">
        <thead>
            <tr>';

foreach ($columns as $key => $column) {
    echo '<th scope="col">' . $key . '</th>';
}

echo '<th scope="col">Acciones</th>';

echo '
            </tr>
        </thead>
        <tbody>';

foreach ($rows as $row) {
    echo '<tr>';

    foreach ($row as $value) {
        echo '<td>' . $value . '</td>';
    }
    echo '<td class="text-center">
    <button title="Añadir" type="button" class="btn btn-success mx-1" style="margin: -0.25em;" onclick="addRegistro(' . $row['id'] . ')"><i class="fa fa-plus" aria-hidden="true"></i></button>
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
        document.cookie = 'deleteId=' + deleteId + ';path=/administrador';
        location.reload();
    }
</script>