<?php
session_start();

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
    abort("Error while accessing database. Please contact your administrator.");
}

function escape(string $str) : string {
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