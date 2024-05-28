<?php 
    // Si il n'est pas connecté, redirection
require "../../../../ressources/service/_shouldBeLogged.php";
shouldBeLogged(true, "../../connexion.php");

// Si on n'a pas d'id en get, redirection
if(empty($_GET["id"])) goToListe();

require "../../../../ressources/service/_pdo.php";
$pdo = connexionPDO();

$sql = $pdo->prepare("SELECT idUser FROM messages WHERE idMessage = ?");
$sql->execute([(int)$_GET["id"]]);
$message = $sql->fetch();
// Si on n'a pas de message ou si l'utilisateur n'est pas le propriétaire du message. Redirection.
if(!$message || $message["idUser"] != $_SESSION["idUser"]) goToListe();


$sql = $pdo->prepare("DELETE FROM messages WHERE idMessage=?");
$sql->execute([(int)$_GET["id"]]);

$_SESSION["flash"] = "Votre message a bien été supprimé.";
goToListe();
function goToListe(){
    header("Location: ./read.php?id=".$_SESSION["idUser"]);
    exit;
}
?>