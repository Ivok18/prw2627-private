<?php
require_once "functions.php";
    // ICI
    $pseudo = "";
    $password = "";
    $password_confirm = "";
    if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
        $pseudo = trim($_POST['pseudo']);
        $query = $pdo->prepare("select * from Members where pseudo = :pseudo");
        $query->execute(["pseudo" => $pseudo]);
        $profile = $query->fetch();
        if($query->rowCount() != 0){    // Pseudo already exist
            $errors[] = "Pseudo ".$pseudo." already exists";
        } else {   // Pseudo doesnt exist
            if(mb_strlen($pseudo) < 3) { // Minimum length 3
                $errors[] = "Pseudo minimum length is 3";
            }
            
            if(empty($_POST['password']) && empty($_POST['confirm_password'])) {

                // proceeds without password => sign-up
                // SIGN UP !!
                session_regenerate_id(true);
                $_SESSION['user'] = $pseudo;
                $query = $pdo->prepare("insert into members(pseudo, password) values (:pseudo, :password)"); 
                $query->execute([
                    "pseudo" => $pseudo,
                    "password" => password_hash("", PASSWORD_BCRYPT)
                ]);
                redirect("profile.php");


            } else { // Password verification
                $password = trim($_POST['password']);
                $password_confirm = trim($_POST['password_confirm']);

                if($password === $password_confirm) {

                    // both password same => sign-up
                    // SIGN UP !!
                    session_regenerate_id(true);
                    $_SESSION['user'] = $pseudo;
                    $query = $pdo->prepare("insert into members(pseudo, password) values (:pseudo, :password)"); 
                    $query->execute([
                    "pseudo" => $pseudo,
                    "password" => password_hash($password, PASSWORD_BCRYPT)
                ]);
                redirect("profile.php");

                } else {
                    // different
                    $errors[] = "Two passwords do not match.";
                } 
            }
        
        }
    } 
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="title">Sign Up</div>
        <div class="menu">
            <a href="index.php">Home</a>
        </div>
        <div class="main">
            <h4>Please enter your details to sign up:</h4>
            <form action="signup.php" method="post">
                <table>
                    <tr>
                        <td>Pseudo:</td>
                        <td><input id="pseudo" name="pseudo" type="text" value=<?= escape($pseudo) ?>></td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input id="password" name="password" type="password" value=<?= escape($password) ?>></td>
                    </tr>
                    <tr>
                        <td>Confirm Password:</td>
                        <td><input id="password_confirm" name="password_confirm" type="password" value=<?= escape($password_confirm) ?>></td>
                    </tr>
                </table>
                <input type="submit" value="Sign Up">
            </form>
             <?php
            if(isset($errors)) {
                echo "<div class='errors'>";
                echo "<ul>";

                    foreach($errors as $error) {
                    echo "<li>".$error."</li>";
                    }
                    echo "</ul>";
                    echo "</div>";
            }?>
        </div>
    </body>
</html>
