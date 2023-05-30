<?php

print('
<div class="col-md-12">
    <div class="jumbotron">
        <h1 class="display-3 text-center">LOL WIKI</h1>
    </div>
</div>
');

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://lolesportswiki.info/api/handler.php/splitleague/list',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => 'GET',
));

$splitleagues = str_replace('/var/www/vhosts/40650746.servicio-online.net/lolesportswiki.info/api', '', curl_exec($curl));
$splitleagues = json_decode($splitleagues, true);
$splitleagues = array_reverse($splitleagues);

// comprovar que temporada es
$hoy = new DateTime();
$primavera = new DateTime('March 20');
$verano = new DateTime('June 20');
$otoño = new DateTime('September 22');
$invierno = new DateTime('December 21');

$estacionActual = '';

switch(true) {
    case $hoy >= $primavera && $hoy < $verano:
        $estacionActual = 'Primavera';
        break;

    case $hoy >= $verano && $hoy < $otoño:
        $estacionActual = 'Verano';
        break;

    case $hoy >= $otoño && $hoy < $invierno:
        $estacionActual = 'Otoñó';
        break;

    default:
        $estacionActual = 'Invierno';
}

$splitleagueCards = '
<h4>Ligas actuales</h4>
<div class="col-md-12 border p-2 mb-5">
<div class="row">';
foreach ($splitleagues as $splitleague) {
    if (($hoy->format('Y') == $splitleague['año']) && ($estacionActual === $splitleague['split']) && ('INT' !== $splitleague['region'])) {
        $img_size = explode('x', $splitleague['image_size']);
        $splitleagueCards .= '<div class="col-sm-3 mb-3">';
        $splitleagueCards .= '<div class="card">';
        $splitleagueCards .= '
        <div class="card-header align-items-center text-center" style="height: 4em;">
            <h5 class="card-title">' . $splitleague['liga_abr'] . ' ' . $splitleague['split'] . ' ' . $splitleague['año'] . '</h5>
        </div>
        <div class="card-body d-flex align-items-center bg-white mx-auto" style="min-height: 250px;">
            <a href="' . $url . 'detalles.php?typePage=splitleague&id=' . $splitleague['id'] . '"><img src="' . $splitleague['image'] . '" class="card-img-top" style="max-width: ' . $img_size[1] . 'px;" alt="Imagen" height="' . $img_size[0] . '"></a>
        </div>';
        $splitleagueCards .= '</div></div>';
    }
}
$splitleagueCards .= '</div></div>';

print($splitleagueCards);

$splitleagueInternationalCards = '
<h4>Eventos internacionales</h4>
<div class="col-md-12 border p-2 mb-5">
<div class="row">';
foreach ($splitleagues as $splitleague) {
    if (($hoy->format('Y') == $splitleague['año']) && ('INT' == $splitleague['region'])) {
        $img_size = explode('x', $splitleague['image_size']);
        $splitleagueInternationalCards .= '<div class="col-sm-3 mb-3">';
        $splitleagueInternationalCards .= '<div class="card">';
        $splitleagueInternationalCards .= '
        <div class="card-header align-items-center text-center" style="height: 4em;">
            <h5 class="card-title">' . $splitleague['liga_abr'] . ' ' . $splitleague['split'] . ' ' . $splitleague['año'] . '</h5>
        </div>
        <div class="card-body d-flex align-items-center bg-white mx-auto" style="min-height: 250px;">
            <a href="' . $url . 'detalles.php?typePage=splitleague&id=' . $splitleague['id'] . '"><img src="' . $splitleague['image'] . '" class="card-img-top" style="max-width: ' . $img_size[1] . 'px;" alt="Imagen" height="' . $img_size[0] . '"></a>
        </div>';
        $splitleagueInternationalCards .= '</div></div>';
    }
}
$splitleagueInternationalCards .= '</div></div>';

print($splitleagueInternationalCards);
