<?php 
/* 
    "refresh:" permet de réactualiser la page au bout de quelques secondes.
    Si on y ajoute "url=" séparé par ";"
    nous pouvons créer une redirection après quelques secondes.
*/
header("refresh: 5; url= 09-a-header.php");
/* 
    En second paramètre on peut indiquer un boolean qui vaut "true" par défaut.
    Celui ci indique si le header doit remplacer le précédent ou s'y ajouter.
    En troisième argument, on peut modifier le code de status (seulement si le header n'est pas vide)
*/
$title = "Header page 2";
require "../ressources/template/_header.php";

echo "<h1>Bienvenue sur la page 2... temporairement.</h1>";

require "../ressources/template/_footer.php";
?>