<?php
require_once "functions.php";
check_login();
try {
    $pdo = connect();
    $query = $pdo->prepare("SELECT pseudo from Members");
    $query->execute();
    $members = $query->fetchAll();
} catch (Exception $exc) {
    abort('Error while accessing database. Please contact your administrator.');
}
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
        <div class="menu">
            <a href="profile.php">Home</a>
            <a href="members.php">Members</a>
            <a href="friends.php">Friends</a>
            <a href="messages.php">Messages</a>
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Log Out</a>
        </div>
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