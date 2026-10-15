<?php
    try
    {
        $pdo = new PDO("mysql:host=localhost;dbname=my_social_network_base;charset=utf8mb4", "root", "root");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = $pdo->prepare("SELECT * FROM Members");
        $query->execute();
        $members = $query->fetchAll();
        echo "<p>Everything seems to work fine</p>";
        echo "<p>Here is the content of the Members table</p>";
        echo "<pre>";
        print_r($members);
        echo "</pre>";
    }
    catch (Exception $exc)
    {
        die("Error while accessing database. Please contact your administrator.");
    }
?>