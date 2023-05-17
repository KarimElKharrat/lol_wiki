<?php

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

use Model\File;

File::includeTemplateFile('adminHeader.php');

?>

<div class="col-md-12">

    <div class="jumbotron">
        <h1 class="display-3">Leagues</h1>
        <p class="lead">Jumbo helper text</p>
        <hr class="my-2">
        <p>More info</p>
        <p class="lead">
            <a class="btn btn-primary btn-lg" href="Jumbo action link" role="button">Jumbo action name</a>
        </p>
    </div>

</div>

<?php

File::includeTemplateFile('adminFooter.php');