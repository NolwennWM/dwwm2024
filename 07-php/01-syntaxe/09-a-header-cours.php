<?php 
/*
    Le header est l'entête de la requête, elle sera lu par le navigateur
    Normalement il faut placer la fonction header() avant tout affichage
    de HTML.
    grâce au header on peut activer plusieurs actions différente :
*/
/* "HTTP/" permet de modifier le code d'état envoyé
200, 300, 404...
Par exemple ici on transforme notre page en 404. */
header("HTTP/1.1 404 Not Found");
// http_response_code permet d'obtenir le code de status.
echo http_response_code();
/* "Location:" va provoquer une redirection, changeant le code 
d'état en 302 et redirigeant vers la page indiqué 
(le lien peut être relatif ou absolu)*/ 
if(rand(0, 100)<50){
    header("Location: 09-b-header-cours.php");
    /* exit permet de mettre fin au script en cours;
    Il est de bon de l'utiliser après une redirection
    pour être sûr que le serveur ne travail pas pour rien */
    exit;
    /* 
    exit peut être utile pour debuger car permet d'arrêter
    le script php en cours afin de voir où est provoqué un 
    problème. 
    Optionnellement on peut demander à exit d'afficher 
    un message:
    exit("On s'arrête ici !");

    Pour ceux qui préfères, exit à un Alias nommé :
    die;
    */
}
// header("Location: 09-b-header.php");
$title = " header page 1";
require("../ressources/template/_header.php");
?>
<h1>Vous avez de la chance de pouvoir me voir.</h1>
<?php
require("../ressources/template/_footer.php");
?>
