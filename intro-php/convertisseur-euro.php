<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
 <?php
    if(isset($_GET['val'])) {
        $value = (float)$_GET['val'];
        if(is_numeric($value)) {
            $multiplier = 40.3399;
            $conversion = $value * $multiplier; 
            echo "<p>".$value." BEF = ".$conversion." EUR </p>";
            echo "<p><a href='?'>Retour</a></p>";
        } else {
            echo "<a href='?'>Retour</a>";
        }

    } else {
        ?>
        <form method="GET" action=''>
            <p>
                Value :
                <input type='number' name='val' required/>
            </p>
            <p><input type='submit'></p>
        </form>
        <?php
    }
 ?>
</body>
</html>