<?php

    require "../../../ressources/service/_shouldBeLogged.php";
    require "../../../ressources/service/_pdo.php";

    shouldBeLogged(true, "../connexion.php");

    if(!isset($_SESSION["idUser"], $_GET["id"]) || $_SESSION["idUser"] != $_GET["id"]) {
        header("Location: /");
        exit;
    }

    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM messages WHERE idUser=? AND idMessage=?");
    $sql->execute([(int)$_GET['id'], (int)$_GET['idMessage']]);
    $message =$sql->fetch();

    if($message["idUser"] != $_SESSION["idUser"]) {
        header("Location: /");
        exit;
    } else {
        $sql = $pdo->prepare("DELETE FROM messages WHERE idUser=? AND idMessage=?");
        $sql->execute([(int)$_GET["id"], (int)$_GET["idMessage"]]);

        $_SESSION["flash"] = "Votre message a été supprimé";
        
        header("Location: ./read.php?id={$_SESSION['idUser']}");
        exit;
    }



?>