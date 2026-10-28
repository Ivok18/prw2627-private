<?php
require_once "functions.php";
$pseudo = "";
$password = "";
$password_confirm = "";

if(isset($_POST['pseudo']) && !empty($_POST['pseudo'])) {
    $pseudo = trim($_POST['pseudo']);
    if(!is_pseudo_available($pseudo)){    
        $errors[] = "Pseudo ".$pseudo." already exists";
    } else {  
        $is_too_short = mb_strlen($pseudo);
        if($is_too_short) { 
            $errors[] = "Pseudo minimum length is 3";
        }
        
        $is_signup_no_password = (empty($_POST['password']) && empty($_POST['confirm_password']));
        if($is_signup_no_password) {
            session_regenerate_id(true);
            $_SESSION['user'] = $pseudo;
            insert_member($pseudo, "");
            redirect("profile.php");
        } else {
            $password = trim($_POST['password']);
            $password_confirm = trim($_POST['password_confirm']);
            $passwords_match = $password === $password_confirm;
            if($passwords_match) {
                session_regenerate_id(true);
                $_SESSION['user'] = $pseudo;
                insert_member($pseudo, $password);
                redirect("profile.php");
            } else {
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
