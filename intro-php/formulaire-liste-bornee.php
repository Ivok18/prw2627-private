<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        if(isset($_POST['inf']) && isset($_POST['sup'])) {
            // LISTE BORNEE
            $inf = $_POST['inf'];
            $sup = $_POST['sup']; 

            if(is_numeric($inf) && is_numeric($sup) && $inf < $sup) {
                $inf = (int)$_POST['inf'];
                $sup = (int)$_POST['sup']; 
                echo "<ul>";
                for($i = $inf; $i < $sup; ++$i) {
                    echo "<li>$i</li>";
                }
                echo "</ul>";
            } else {
                echo "Erreur, les deux paramètres doivent etre numeriques et valides (inf < sup)";
            }
        } else {
            // FORMULAIRE
            echo "<form action='' method='POST'>
                <div>
                    <label> Borne inférieure: <input name='inf'> </label>
                </div>
                <div>
                    <label> Borne supérieure: <input name='sup'>    </label>
                </div>
                <div>
                    <button> Go! </button> 
                </div
            </form>";
        } 
    ?>
</body>
</html>