<div class="w-75" style="margin: auto;">
<div class="row">

<?php

use Model\File;

$xd = 'https://www.w3schools.com/bootstrap4/img_avatar1.png';

$regions = [
    'lpl' => [
        'name' => 'China',
        'logo' => FILE::getFilePathByName('lec.png'),
        'prueba' => 'https://static.wikia.nocookie.net/lolesports_gamepedia_en/images/a/a1/LPL_2020.png'
    ],
    'lck' => [
        'name' => 'Corea',
        'logo' => FILE::getFilePathByName('lec.png'),
        'prueba' => 'https://upload.wikimedia.org/wikipedia/en/thumb/1/13/League_of_Legends_Champions_Korea_logo.svg/1200px-League_of_Legends_Champions_Korea_logo.svg.png'
    ],
    'lcs' => [
        'name' => 'Norte América',
        'logo' => FILE::getFilePathByName('lec.png'),
        'prueba' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/71/League_championship_series_logo_2021.svg/1200px-League_championship_series_logo_2021.svg.png'
    ],
    'lec' => [
        'name' => 'Europa',
        'logo' => FILE::getFilePathByName('lec.png'),
        'prueba' => 'https://www.fullesports.com/wp-content/uploads/2020/06/LEC_2019.png',
    ],
];

foreach ($regions as $key => $region) {
    echo
    '
    <div class="col-md-3 mb-3">
        <div class="card bg-light border-light mb-3">
            <img class="card-img-top" src="' . $region['prueba'] . '">
            <div class="card-body text-center">
                <h4 class="card-tittle"><b>' . $region['name'] . '</b></h4>
                <a name="" id="" class="btn btn-primary" href="#" role="button"> Ver más </a>
            </div>
        </div>
    </div>
    ';
}

echo '
</div>
</div>
</div>
';
