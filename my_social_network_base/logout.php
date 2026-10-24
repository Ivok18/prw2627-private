<?php
    require_once("functions.php");
    $_SESSION = []; //on clean array
    session_destroy(); 
    redirect('index.php'); 
?>