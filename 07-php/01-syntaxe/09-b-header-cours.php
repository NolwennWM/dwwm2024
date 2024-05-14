<?php 
/* 
    "refresh:" permet de raffraichir la page
    au bout de quelques secondes.
    Si on y ajoute "url=" séparé par un ";"
    Nous nous retrouvons avec une redirection
    au bout de quelques secondes.
*/
header("refresh:5; url=09-a-header-cours.php");
/* En second paramètre on peut indiquer un boolean
par défaut à true, qui indique si le header doit 
remplacer le précédent ou juste s'y ajouter.

et en troisième on peut fixe un code 
de status pour la page. mais ce troisième 
est utilisable uniquement si le premier n'est 
pas vide.*/
$title = " header page 2";
require("../ressources/template/_header.php");
?>
<h1>Bienvenue sur la page 2.... temporairement.</h1>
<?php
require("../ressources/template/_footer.php");
?>
