<?php 

// Comment déterminer la taille d'une chaîne de caractères ? Essayez également avec des caractères accentués.
$str = "house on FIRE haunted";
$length = strlen($str);
echo "string: ". $str;
echo "length: ".$length;

// Comment déterminer si une chaine de caractères contient un @ ?
$hasArobase = str_contains($str, "@");
echo $str. " contains @ ?: ".$hasArobase;

// Comment déterminer si une chaîne de caractères commence par un @ ?
$startsWithArobase = str_starts_with($str, "@");
echo $str. " starts with @ ?: ".$$startsWithArobase;

// Comment enlever le premier caractère d'une chaîne ?
$strChanged = substr($str, 1);
echo "original: ".$str;
echo "first character removed: ".$strChanged;

// Comment transformer une chaîne de caractères en un tableau de mots (si les mots sont séparés par des espaces).
$tab = str_split($str);
for ($i = 0; $i < strlen($str); ++$i) {
    echo $tab[$i];
}

// Comment enlever les espaces qu'il y aurait au début et à la fin d'une chaîne de caractères ?
$strWithoutSpaces = trim($str);
echo "original: ".$str;
echo "first character removed: ".$strWithoutSpaces;


// Comment, dans une chaîne, remplacer toutes les apparitions d'un mot par un autre ?
$word = "";
$strUpdated = str_replace("h", "NOO", $str);
echo "original: ".$str;
echo "with word replaced ".$strUpdated;
?>