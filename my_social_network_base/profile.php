
<?php
require_once "functions.php";

check_login();
$member = get_member($user);
$description = $member['profile'] ?? "";
$picture_path = $member['picture_path'] ?? "";

?>
<!DOCTYPE html>
<html>
    <head>
        <!-- escape here -->
        <title><?= escape($user)?> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

         <!-- escape here -->
        <div class="title"><?= escape($user) ?> Profile!</div>
        <?php include_menu() ?>
        <div class="main">
            <div>
                <?php
                if(mb_strlen(escape($description) ?? '') == 0) {
                    echo 'No profile string entered yet!';
                } else {
                    echo escape($description);
                }
            ?>
            </div>
            <div>
                <?php 
                if(mb_strlen(escape($picture_path) ?? '') == 0) {
                    echo "No picture loaded yet";
                } else {
                    $path_esc = escape($picture_path);
                    $pseudo_esc = escape($user);
                    echo "<img src=\"$path_esc\" width=\"100\" alt=\"$user&apos;s picture\">";
                }
                ?>
            </div>
        </div>
    </body>
</html>
