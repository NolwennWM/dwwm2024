<?php

    require "../../../ressources/service/_shouldBeLogged.php";
    require "../../../ressources/service/_pdo.php";
    require "../../../ressources/service/_csrf.php";
    shouldBeLogged(true, "../connexion.php");

    $message = "";

    if($_SERVER["REQUEST_METHOD"] === 'POST' && isset($_POST["sendMsg"])) {

        $pdo = connexionPDO();

        if(empty($_POST["message"])) {
            $error["message"] = "Veuillez entrer un message";
        } else {
            $message = cleanData($_POST["message"]);
            $sql = $pdo->prepare("INSERT INTO messages(message, idUser) VALUES(?, ?)");
            $sql->execute([$message, $_SESSION["idUser"]]);
        }

        header("Location: ./read.php?id={$_SESSION['idUser']}");

    }

?>