<?php
require_once "functions.php";
check_login();

// we retrieve description + picture path from database
$user = $_SESSION['user'];
$query = $pdo->prepare("select * from members where pseudo = :pseudo");
$query->execute(["pseudo" => $user]);
$profile = $query->fetch();
$description = trim($profile['profile']);
$picture_path = trim($profile['picture_path']);
$old_desc = $description;

// we apply modifications if they were made
if(isset($_POST['profile'])) {
    try {
        $description = trim($_POST['profile']);
        $query = $pdo->prepare("update members set profile = :desc where pseudo = :pseudo");
        $query->execute([
            "desc" => $description,
            "pseudo" => $user
        ]);
    } catch (Exception $e) {
        $msg = "Error: ".$e;
        $errors[] = $msg;
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Update Your Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Update Your Profile</div>
        <div class="menu">
            <a href="profile.php">Home</a>
            <a href="members.php">Members</a>
            <a href="friends.php">Friends</a>
            <a href="messages.php">Messages</a>
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Log Out</a>
        </div>
        <div class="main">
            <form method="post" action="edit_profile.php" enctype="multipart/form-data">
                <h4>Enter or edit your details and/or upload an image.</h4>
                <textarea name="profile" cols="50" rows="3"><?= escape($description) ?></textarea>

                Image: <input type="file" name="image" accept="image/x-png, image/gif, image/jpeg">
                <img src=<?= escape($picture_path) ?> width="100" alt="profile picture">

                <input type="submit" value="Save Profile">
            </form>
            <?php 
            if(!isset($errors) && $old_desc !== $description) {
                echo "<div class = 'success'> Your profile have successfully been updated. </div>";
            }
            ?>
        </div>
    </body>
</html>

