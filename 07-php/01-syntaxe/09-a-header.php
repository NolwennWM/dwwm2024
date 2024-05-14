<?php 
/* 
    Les headers sont l'entête de la requête qui est lu par le navigateur ou le serveur avant de vérifier le contenu du fichier.

    Toute modification des headers doit se faire avant l'affichage de quelconque données.

    La modification de headers peut se faire par la création de cookie comme avec les sessions vu précédement.

    Mais on peut aussi utiliser la fonction "header()" pour les modifier.

    On pourra l'utiliser par exemple pour modifier le code de status.
        200, 300, 404...
*/
// header("HTTP/1.1 404 Not Found");

# pour gérer automatiquement le protocol :
// header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found");

# Si on veut juste changer le code et garder le message par défaut :
http_response_code(404);

/* 
    On peut aussi se servir de la fonction header pour provoquer une redirection :
*/
if(rand(0, 100) < 50)
{
    header("Location: 09-b-header.php");
    /* 
        "exit" met fin au code, 
        tout ce qui suis ne sera pas lu.
        Par sécurité on fait cela après chaque redirection afin d'être sûr qu'aucun code n'est executé.
        exit a un alias qui fait exactement la même chose appelé "die"
    */
    exit;
}
$title = "Header page 1";
require "../ressources/template/_header.php";

echo "<h1>Vous avez de la chance de me voir</h1>";

require "../ressources/template/_footer.php";
?>