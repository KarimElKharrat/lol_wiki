<?php

require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'bootstrap.php';

File::includeTemplateFile('adminHeader.php');

?>

<div class="col-md-12 mt-3">

    <table class="table table-hover border">
        <thead>
            <tr>
                <th scope="col">Type</th>
                <th scope="col">Column heading</th>
                <th scope="col">Column heading</th>
                <th scope="col">Column heading</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">Default</th>
                <td>Column content</td>
                <td>Column content</td>
                <td><button type="button" class="btn btn-primary">xd</button></td>
            </tr>
        </tbody>
    </table>

</div>

<?php

File::includeTemplateFile('adminFooter.php');
