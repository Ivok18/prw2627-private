<?php
require_once "functions.php";
check_login();
$members = get_members();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Members</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Members</div>
        <?php include_menu() ?>
        <div class="main">
            <ul>
            <?php 
                foreach($members as $member) { 
                    $pseudo = $member['pseudo'];
                    $pseudo_esc = escape($pseudo);
                    echo "<li><a href='profile.php?pseudo=$pseudo'>$pseudo_esc</li>";
                }
            ?>
            </ul>
        </div>
    </body>
</html>