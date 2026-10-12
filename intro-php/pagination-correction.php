<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Liste bornée avec formulaire et pagination</title>
    </head>
    <body>
        <?php
        $PAGE_SIZE = 20;
        
        if (isset($_GET["inf"]) && isset($_GET["sup"]))
        {
            $inf = $_GET["inf"];
            $sup = $_GET["sup"];
            
            $page = 0;
            if (isset($_GET["page"]) && is_numeric($_GET["page"]))
                $page = (int) $_GET["page"];
            
            //on verifie que $inf et $sup sont des strings numeriques !
            if (is_numeric($inf) && is_numeric($sup))
            {
                //conversion en entier (l'utilisateur aurait pu rentrer
                //des reels).
                $inf = (int) $inf;
                $sup = (int) $sup;
                
                // on calcule le nombre de pages en fonction des bornes
                $num_pages = (int)(($sup - $inf + $PAGE_SIZE) / $PAGE_SIZE);

                // si la page demandée est inférieure à 0 (première page) ou supérieure
                // ou égale au nombre maximum de pages, on remet $page à zéro, ce qui revient
                // à ignorer ce paramètre.
                if ($page < 0 || $page >= $num_pages)
                    $page = 0;

                // on calcule les indices de début (compris) et de fin (non comprise) pour
                // la page demandée.
                $start = $inf + $page * $PAGE_SIZE;
                $end = min($sup + 1, $start + $PAGE_SIZE);
                
                // on affiche la page demandée
                echo "<ul>";
                for ($i = $start; $i < $end; ++$i)
                {
                    echo "<li>" . $i . "</li>";
                }
                echo "</ul>";

                $next_page = $page + 1;
                
                // si la page courante n'est pas la première, on affiche "<<" (via 
                // l'entité &lt; car la caractère < est réservé en HTML5.
                if ($page > 0)
                    echo "<a href='?inf=$inf&sup=$sup&page=". ($page - 1) . "'>&lt;&lt;</a> ";
                
                // on affiche la liste des pages en mettant comme texte la première valeur de la page.
                // Par contre, c'est bien le numéro de la page qu'on passe comme paramètre de l'url.
                for ($i=0; $i<$num_pages; ++$i){
                    echo "<a href='?inf=$inf&sup=$sup&page=$i'>" . ($inf + $i * $PAGE_SIZE) . "</a> ";
                }

                // si la page courante n'est pas la dernière, on affiche ">>"
                if ($page + 1 < $num_pages)
                    echo "<a href='?inf=$inf&sup=$sup&page=" . ($page + 1) . "'>>></a>";
                
                echo "<p><a href='?'>Modifier paramètres</a></p>";
            }
            else
            {
                echo "<p>les paramètres ne sont pas numériques</p>";
            }
        }
        else
        {
            ?>
            <form method="get" action="">
                <p><input type="number" name="inf" value="1" required/></p>
                <p><input type="number" name="sup" value="150" required/></p>
                <p><input type="submit"/></p>
            </form>
    <?php
}
?>
    </body>
</html>