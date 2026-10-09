<?php

// creation tableau
$utilisateur = [
    "Nom" => "Dupond",
    "Prenom" => "Jacques", 
    "Rue" => "Rue du Web",
    "Numero" => 60,
    "Code Postal" => 4242,
    "Ville" => "WebCity",
    "Telephone" => "0488/42 42 42" 
];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <th>Key</th>
            <th>Value</th>
        </thead>
        <tbody>
            <?php foreach ($utilisateur as $key => $value) {
                echo "<tr> 
                        <td>".$key."</td> 
                        <td>".$value."</td> 
                    </tr>";
            }?>
        </tbody>
    </table>
</body>
</html>

