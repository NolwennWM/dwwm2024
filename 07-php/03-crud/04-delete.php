<?php
// Si on n'est pas connecté, on est redirigé vers une autre page
require "../ressources/service/_shouldBeLogged.php";
shouldBeLogged(true, "./exercice/connexion.php");

// Si l'utilisateur connecté est différent de l'utilisateur qu'on tente de supprimer, alors on le redirige.
if(!isset($_SESSION["idUser"], $_GET["id"]) || $_SESSION["idUser"] != $_GET["id"])
{
    header("Location: ./02-read.php");
    exit;
}

// on supprime l'utilisateur :
require "../ressources/service/_pdo.php";

$connexion = connexionPDO();
$sql = $connexion->prepare("DELETE FROM users WHERE idUser=?");
$sql->execute([(int)$_GET["id"]]);

// On déconnecte l'utilisateur :
unset($_SESSION);
session_destroy();
setcookie("PHPSESSID", "", time()-3600);

// J'affiche une page de confirmation avant de le rediriger:
header("refresh: 5; url= ./02-read.php");

$title = "CRUD - Delete";
require "../ressources/template/_header.php";
?>
<p>
    Vous avez bien <strong>supprimé</strong> votre compte. <br>
    Vous allez être reidirigé d'ici peu.
</p>
<?php 
require "../ressources/template/_footer.php";
?>