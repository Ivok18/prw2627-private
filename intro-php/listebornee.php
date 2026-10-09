<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php 
        if (isset($_GET['inf']) && isset($_GET['sup'])) {

            $inf = $_GET['inf'];
            $sup = $_GET['sup']; 

            if(is_numeric($inf) && is_numeric($sup) && $inf < $sup) {
                  $inf = (int)$_GET['inf'];
                  $sup = (int)$_GET['sup']; 
                for($i = $inf; $i < $sup; ++$i) {
                    echo "<li>$i</li>";
                }
            } else {
                 echo "Erreur, les deux paramètres doivent etre numeriques et valides";
            }
        } else {
           echo "Erreur, il faut renseigner une borne inferieur et superieur";
        }
        ?>
    </ul>
</body>
</html>