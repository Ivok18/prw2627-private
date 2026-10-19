<?php
$dbhost = "localhost";
$dbname = "my_social_network_base";
$dbuser = "root";
$dbpassword = "root";


try {
    // connexion to database
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname;charset=utf8mb4",$dbuser, $dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (Exception $e) {
    // error during connexion
    die("Error while accessing database. Please contact your administrator.");
}

function escape(string $str) : string {
    return htmlspecialchars((string)$str, ENT_QUOTES, "UTF-8");
}

function redirect(string $url, $statusCode = 303) {
    header('Location: '. $url, true, $statusCode);
    die();
}
?>