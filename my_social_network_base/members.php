<?php
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=my_social_network_base;charset=utf8mb4", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $query = $pdo->prepare("SELECT pseudo from Members");
        $query->execute();
        $members = $query->fetchAll();
    } catch (Exception $exc) {
        die('Error while accessing database. Please contact your administrator.');
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
                    echo "<li>".$member['pseudo']."</li>";
                }
            ?>
            </ul>
        </div>
    </body>
</html>