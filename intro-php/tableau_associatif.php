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

/*
    Example : 
    foreach ($array as $key => $value) {
    echo "Key: $key => Value: $value\n";
}
*/
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
            <th scope='col'>Key</th>
            <th scope='col'>Value</th>
        </thead>
        <tbody>
        </tbody>
    </table>
</body>
</html>

