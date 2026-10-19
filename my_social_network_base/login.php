<?php
require_once "functions.php";

if(isset($_POST['pseudo']) && isset($_POST['password'])) {
    // both input entered
    $pseudo = trim($_POST['pseudo']);
    $password = trim($_POST['password']);

    // we try to find pseudo in database
    $query = $pdo->prepare("SELECT * from Members where pseudo = :pseudo");
    $query->execute(["pseudo" => $pseudo]);
    $profile = $query->fetch();
    if($query->rowCount() == 0) {
        $errors[] = "Can't find a member with the pseudo '".$pseudo."'. Please sign-up";
    } else {
        // password incorrect
        if($profile['password'] != $password) {
            $errors[] = "Wrong password. Try again.";
        } else { // password correct
            redirect("profile.php?pseudo=$pseudo");
        }
    }
} else {
    // one of them not entered
    if(!isset($_POST['pseudo']) && isset($errors)) {
        $errors[] = "Pseudo required.";
    } 
    if(!isset($_POST['password']) && isset($errors)) {
        $errors[] = "Password required.";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Log In</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Log In</div>
        <div class="menu">
            <a href="index.php">Home</a>
            <a href="signup.php">Sign Up</a>
        </div>
        <div class="main">
            <form action="login.php" method="post">
                <table>
                    <tr>
                        <td>Pseudo:</td>
                        <td><input id="pseudo" name="pseudo" type="text" value=""></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input id="password" name="password" type="password" value=""></td>
                    </tr>
                </table>
                <input type="submit" value="Log In">
            </form>
            <ul>
                <?php
                if(isset($errors)) {
                    echo "<div class=\"errors\">";
                    foreach($errors as $error) {
                        echo "<li>".$error."</li>";
                    }
                    echo "</div>";
                }
                ?>
            </ul>
            
        </div>
    </body>
</html>
