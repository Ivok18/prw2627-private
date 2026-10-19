
<?php
require_once "functions.php";

if(isset($_GET['pseudo'])) { // on verifie si le pseudo a été entré dans l'input..

    $pseudo = trim($_GET['pseudo']);  // si oui, on récupère dans une variable..
    try { // on essaie de récupérer le pseudo contenu dans la variable en se connectant à la db..
        $query = $pdo->prepare("SELECT * from Members where pseudo = :pseudo"); // requête db
        $query->execute(["pseudo" => $pseudo]);
        $profile = $query->fetch(); // un seul résultat au maximum
        if($query->rowCount()==0) { // si la requête retourne rien, pas de pseudo
            die("Can't find user '$pseudo' in the database");
        } else { // si la requête retourne on affiche les infos de la ligne du pseudo existant dans la db
            $description = $profile['profile'];
            $picture_path = $profile['picture_path'];
        }
    } catch (Exception $exc) { // si porblème dans la requête, message d'erreur
        die("Error while accessing database. Please contact your administrator.");
    }
} else { // si pas de pseudo entré en input, message d'erreur
    die("This page expects a 'pseudo' parameter via the GET method");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- escape here -->
        <title><?= escape($pseudo)?> </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>

         <!-- escape here -->
        <div class="title"><?= escape($pseudo) ?> Profile!</div>
        <div class="menu">
            <a href="profile.php">Home</a>
            <a href="members.php">Members</a>
            <a href="friends.php">Friends</a>
            <a href="messages.php">Messages</a>
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Log Out</a>
        </div>
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
                    $pseudo_esc = escape($pseudo);
                    echo "<img src=\"$path_esc\" width=\"100\" alt=\"$pseudo&apos;s picture\">";
                }
                ?>
            </div>
        </div>
    </body>
</html>
