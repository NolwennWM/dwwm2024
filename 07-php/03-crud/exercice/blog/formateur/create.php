<?php 
require "../../../../ressources/service/_shouldBeLogged.php";
require "../../../../ressources/service/_csrf.php";
shouldBeLogged(true, "../connexion.php");
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['addMessage']))
{
    if(empty($_POST["message"]))
    {
        $_SESSION["flash"] = "Veuillez entrer un message";
    }else{
        require "../../../../ressources/service/_pdo.php";
        $message = cleanData($_POST["message"]);

        $pdo = connexionPDO();
        // Partie 1 uniquement
        // $sql = $pdo->prepare("INSERT INTO messages(message, idUser) VALUES (:m, :id)");
        // Fin partie 1
        // Partie 2 uniquement 
        if(empty($_POST["categorie"])){
            $sql = $pdo->prepare("INSERT INTO messages(message, idUser) VALUES (:m, :id)");
        }else{
            $sql = $pdo->prepare("SELECT * FROM category WHERE idCat = ?");
            $sql->execute([(int)$_POST["categorie"]]);
            $cat = $sql->fetch();
            if($cat){
                $sql = $pdo->prepare("INSERT INTO messages(message, idUser, idCat) VALUES (:m, :id, :cat)");
                $sql->bindValue("cat", $cat["idCat"]);
            }else{
                $_SESSION["flash"] = "Cette catégorie n'exite pas.";
                goto redirect;
            }
        }
        // Fin partie 2.
        $sql->bindValue("m", $message);
        $sql->bindValue("id", (int)$_SESSION["idUser"], PDO::PARAM_INT);
        $sql->execute();

        $_SESSION["flash"] = "Message envoyé";
    }
}
// partie 2 uniquement
redirect:
// fin partie 2.
header("Location: ./read.php?id=".$_SESSION["idUser"]);
die;
?>