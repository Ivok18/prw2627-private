<?php
session_start();



function connect() : PDO {
    $dbhost = "localhost";
    $dbname = "my_social_network_base";
    $dbuser = "root";
    $dbpassword = "root";
    $pdo = null;
    try {
        // connexion to database
        $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4",$dbuser, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (Exception $e) {
        // error during connexion
        abort("Error while accessing database. Please contact your administrator.");
    }

    return $pdo;
}

function include_menu() {
    echo 
    "<div class='menu'>
        <a href='profile.php'>Home</a>
        <a href='members.php'>Members</a>
        <a href='friends.php'>Friends</a>
        <a href='messages.php'>Messages</a>
        <a href='edit_profile.php'>Edit Profile</a>
        <a href='logout.php'>Log Out</a>
    </div>";   
}


function is_pseudo_available($pseudo) {
    $pdo = connect();
    try{
        $query = $pdo->prepare("select * from members where pseudo = :pseudo");
        $query->execute(["pseudo" => $pseudo]);
        $result = $query->fetchAll();
        return count($result) === 0;
    } catch (Exception $e) {
        abort("Error while connecting to the database. Please contact your administrator.");
    }
}

function insert_member($pseudo, $password) {
    $pdo = connect();
    try {
        $query = $pdo->prepare("insert into members(pseudo, password) values (:pseudo, :password)"); 
        $query->execute([
            "pseudo" => $pseudo,
            "password" => password_hash($password, PASSWORD_BCRYPT)
        ]);
    } catch (Exception $ex) {
        abort("Error while inserting member. Please contact your administrator.");
    }
}

function get_member($user) {
    $pdo = connect();
    try {
        $query = $pdo->prepare("select profile, picture_path from members where pseudo = :pseudo");
        $query->execute(["pseudo" => $user]);
        $result = $query->fetch();
        if($query->rowCount()==0) { // si la requête retourne rien, pas de pseudo
            abort("Can't find user '$user' in the database");  
        } 
        return $result;
    }  catch (Exception $ex) {
        abort("Error while inserting member. Please contact your administrator.");
    }
}

function get_members() {
    try {
        $pdo = connect();
        $query = $pdo->prepare("SELECT pseudo from Members");
        $query->execute();
        return $query->fetchAll();
    } catch (Exception $exc) {
        abort('Error while accessing database. Please contact your administrator.');
    }
}

function escape($str) : string {
    return htmlspecialchars((string)$str, ENT_QUOTES, "UTF-8");
}

function redirect(string $url, $statusCode = 303) {
    header('Location: '. $url, true, $statusCode);
    abort("");
}

function check_login()
{
    global $user;
    if (!isset($_SESSION['user']))
        redirect('index.php');
    else 
        $user = $_SESSION['user'];
}

function abort(string $err) {
    global $error;
    $error = $err;
    include 'error.php';
}
?>