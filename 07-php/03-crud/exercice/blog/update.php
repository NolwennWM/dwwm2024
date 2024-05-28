<?php

    require "../../../ressources/service/_shouldBeLogged.php";
    require "../../../ressources/service/_pdo.php";
    require "../../../ressources/service/_csrf.php";

    shouldBeLogged(true, "../connexion.php");
    $pdo = connexionPDO();

    if(!isset($_SESSION["idUser"], $_GET["id"]) || $_SESSION["idUser"] != $_GET["id"]) {
        header("Location: /");
        exit;
    }

    $sql = $pdo->prepare("SELECT * FROM messages WHERE idMessage=?");
    $sql->execute([(int)$_GET["idMessage"]]);
    $message = $sql->fetch();
    $error = [];

    if($message["idUser"] != $_SESSION["idUser"]) {
        header("Location: /");
        exit;
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send'])) {
        if(empty($_POST["modifier"]) || $_POST["modifier"] === $message["message"]) {
            $message = $message['message'];            
        } else {
            $message = cleanData($_POST["modifier"]);
        }

        if(empty($error)) {
            $sql = $pdo->prepare("UPDATE messages SET message=?, editedAt=current_timestamp() WHERE idMessage=? AND idUser=?");
            $sql->execute([$_POST["modifier"], $_GET["idMessage"], $_SESSION["idUser"]]);

            $_SESSION["flash"] = "Votre message a été modifié.";

            header("Location: ./read.php?id={$_SESSION['idUser']}");
            exit;            
        }

    }

    
    $title = "Modifier un message";
    require "../../../ressources/template/_header.php";

?>

<form action="" method="post">
    <input type="text" name="modifier" value="<?=$message['message']?>">
    <input type="submit" value="Renvoyer" name="send">
    <br>
    <span class="erreur"></span>
</form>

<?php 
    require "../../../ressources/template/_footer.php";
?>