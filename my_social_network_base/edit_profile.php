<?php
require_once "functions.php";

check_login();

$profile = '';
$picture_path = '';
$member = get_member($user);
$description = $member['profile'] ?? "";
$picture_path = $member['picture_path'] ?? "";

if(isset($_POST['profile'])) {
    $description = trim($_POST['profile']);
    $pdo = connect();
    try {
        $query = $pdo->prepare("update members set profile=:profile where pseudo=:pseudo");
        $query->execute(["profile" => $description, "pseudo" => $user]);
        $success = "Your profile has been successfully updated.";
    } catch (Exception $ex) {
        abort("Error while accessing the database. Please contact your administrator");
    }
}

if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
    if($_FILES['image']['error']==0) {
        // we validate image type before saving
        $typeOk = TRUE;

        if($_FILES['image']['type']=="image/gif")
            $saveTo = $user.".gif";
        else if($_FILES['image']['type']=="image/jpeg")
            $saveTo = $user.".jpg";
        else if($_FILES['image']['type']=="image/png")
            $saveTo = $user.".png";
        else {
            $typeOk = FALSE;
            $error = "Unsupported image format: gif, jpeg or png!";
        }

        if($typeOk) {
            move_uploaded_file($_FILES['image']['tmp_name'], $saveTo);
            try {
                $pdo = connect();
                $query = $pdo->prepare("update members set picture_path = :path where pseudo = :pseudo");
                $query->execute(["path" => $saveTo, "pseudo" => $user]);
                $success = "Your profile have been succesfully updated.";
                $picture_path = $saveTo;
            } catch (Exception $ex) {
                abort("Error while accessing the database. Please contact your adminostrator.");
            }
        }
    } else {
        $error = "Error while uploading file.";
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
        <?php include_menu() ?>
        <div class="main">
            <form method="post" action="edit_profile.php" enctype="multipart/form-data">
                <h4>Enter or edit your details and/or upload an image.</h4>
                <textarea name="profile" cols="50" rows="3"><?= escape($description) ?></textarea>

                Image: <input type="file" name="image" accept="image/x-png, image/gif, image/jpeg">
                <img src=<?= escape($picture_path) ?> width="100" alt="profile picture">

                <input type="submit" value="Save Profile">
            </form>
            <?php 
            if(isset($success))
                echo "<div class = 'success'> $success </div>";
            if(isset($error)) 
                  echo "<div class = 'error'> $error </div>";
        
            ?>
        </div>
    </body>
</html>