<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div class="title">Error</div>
        <div class="main">
            <div class="errors"><?= escape($error) ?></div>
        </div>
    </body>
</html>