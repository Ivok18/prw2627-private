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
                // DETAILS PAGINATION
                $inf = (int)$_POST['inf'];
                $sup = (int)$_POST['sup'];
                $maxElements = 20;
                $nbPages = (int)(($sup - $inf + 1) / $maxElements); 
                $currPage = 0;
                $start = $inf + $maxElements * $currPage;
                $end = $start + $maxElements;
                if($start + $maxElements >= $sup) {
                    $end = $sup;
                }
                echo "<ul>";
                for($i = $start; $i <= $end; ++$i) {
                    echo "<li>$i</li>";
                }
                echo "</ul>";

              
                if(!isset($_GET['page'])) {
                    // first click on submit
                    //echo "first click on submit";
                    $i = $inf;
                    while($i <= $sup) {
                        echo "<a href='http://localhost/prw2627-private/intro-php/pagination.php?inf=$inf&sup=$sup&page=$currPage'>".$i."</a> " ;
                        $i+=$maxElements;
                        ++$currPage;
                    }
                    $currPage = 0;
                    if($currPage != $nbPages    ) {
                        $next = $currPage+1;
                        echo "<a href='http://localhost/prw2627-private/intro-php/pagination.php?inf=$inf&sup=$sup&page=$next'> >> </a>";
                    }
                } else {
                    // click on an element of pagination area
                    $currPage = 0;
                    $prev = $currPage-1;
                    if($prev > 0) {
                        echo "<a href='http://localhost/prw2627-private/intro-php/pagination.php?inf=$inf&sup=$sup&page=$prev> << </a>";
                    }
                    $currPage = 0;
                    while($i <= $sup) {
                        $i = $inf + $currPage * $maxElements;
                        echo "<a href='http://localhost/prw2627-private/intro-php/pagination.php?inf=$inf&sup=$sup&page=$currPage'>".$i."</a> ";
                        $i+=$maxElements;
                        ++$currPage;
                    }
                    $currPage = 0;
                    if($currPage != $nbPages) {
                        $nextPage = $currPage + 1;
                        echo "<a href='http://localhost/prw2627-private/intro-php/pagination.php?inf=$inf&sup=$sup&page=$nextPage'> >> </a>";
                    }
                }
            } else {
                echo "<a href='http://localhost/prw2627-private/intro-php/pagination.php'>Modifier les paramètres</a>";
            }
        } else {
            if(isset($_GET['inf']) && isset($_GET['sup'])) {
                // LISTE BORNEE 
                $inf = $_GET['inf'];
                $sup = $_GET['sup']; 
                $currPage = $_GET['page'];

                if(is_numeric($inf) && is_numeric($sup) && $inf < $sup) {
                    // DETAILS PAGINATION
                    $inf = (int)$_GET['inf'];
                    $sup = (int)$_GET['sup'];
                    $currPage = (int)$_GET['page'];
                    $maxElements = 20;
                    $nbPages = (int)(($sup - $inf + 1) / $maxElements); 
                    $start = $inf + $maxElements * $currPage;
                    $end = $start + $maxElements;
                    if($start + $maxElements >= $sup) {
                        $end = $sup;
                    }
                    echo "<ul>";
                    for($i = $start; $i <= $end; ++$i) {
                        echo "<li>$i</li>";
                    }
                    echo "</ul>";

                    // click on an element of pagination area
                    $currPage = (int)$_GET['page'];
                    if($currPage > 0) {
                        $prev = $currPage-1;
                        echo "<a href='http://localhost/prw2627-private/intro-php/pagination.php?inf=$inf&sup=$sup&page=$prev'> << </a>";
                    }
                    $currPage = 0;
                    $i = $inf;
                    while($i <= $sup) {
                        $i = $inf + $currPage * $maxElements;
                        echo "<a href='http://localhost/prw2627-private/intro-php/pagination.php?inf=$inf&sup=$sup&page=$currPage'>".$i."</a> ";
                        $i+=$maxElements;
                        ++$currPage;
                    }
                    $currPage = (int)$_GET['page'];
                    if($currPage != $nbPages) {
                        $nextPage = $currPage + 1;
                        echo "<a href='http://localhost/prw2627-private/intro-php/pagination.php?inf=$inf&sup=$sup&page=$nextPage'> >> </a>";
                    }
                    
                } else {
                    echo "<a href='http://localhost/prw2627-private/intro-php/pagination.php'>Modifier les paramètres</a>";
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
           
        } 
    ?>
</body>
</html>