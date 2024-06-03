<?php 
require __DIR__."/../../ressources/service/_shouldBeLogged.php";
require(__DIR__."/../model/userModel.php");
require(__DIR__."/../model/messageFormateurModel.php");
require(__DIR__."/../model/categorieFormateurModel.php");
/**
 * Gère la page d'affichage des messages d'un utilisateur.
 *
 * @return void
 */
function readMessage(): void
{
    if(empty($_GET["id"])){
        header("Location: /05-mvc");
        exit;
    }
    $messages = $flash = $user =  "";

    $user = getOneUserById((int)$_GET["id"]);
    // On récupère les messages
    if(empty($_GET["cat"]))
    {
        $messages = getMessagesByUser((int)$_GET["id"]);
    }
    else
    {
        $messages = getMessagesByUserAndCategorie((int)$_GET["id"], (int)$_GET["cat"]);
    }
    // On récupère les catégories.
    $categories = getAllCategories();

    if(isset($_SESSION["flash"])){
        $flash = $_SESSION["flash"];
        unset($_SESSION["flash"]);
    }
    require __DIR__."/../view/messageFormateur/list.php";
}
/**
 * Gère la page de création des messages.
 *
 * @return void
 */
function createMessage(): void
{
    shouldBeLogged(true, "/05-mvc/connexion");
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['addMessage']))
    {
        if(empty($_POST["message"]))
        {
            $_SESSION["flash"] = "Veuillez entrer un message";
        }else{
            $message = cleanData($_POST["message"]);

            if(empty($_POST["categorie"])){
                addMessage([$message, (int)$_SESSION["idUser"]]);
                $_SESSION["flash"] = "Message envoyé";
            }else{
                $cat = getCategorieById((int)$_POST["categorie"]);
                if($cat){
                    addMessage(["m"=>$message, "id"=>(int)$_SESSION["idUser"], "cat"=>$cat["idCat"]]);
                    $_SESSION["flash"] = "Message envoyé";
                }else{
                    $_SESSION["flash"] = "Cette catégorie n'exite pas.";
                }
            }
        }
    }
    goToListe();
}
/**
 * Gère la page de suppression des messages.
 *
 * @return void
 */
function deleteMessage(): void
{
    shouldBeLogged(true, "/05-mvc/connexion");

    if(empty($_GET["id"])) goToListe();

    $message = getMessageById((int)$_GET["id"]);

    if(!$message || $message["idUser"] != $_SESSION["idUser"]) goToListe();

    deleteMessageById((int)$_GET["id"]);

    $_SESSION["flash"] = "Votre message a bien été supprimé.";
    goToListe();
}
/**
 * Gère la page de mise à jour des messages.
 *
 * @return void
 */
function updateMessage(): void
{
    shouldBeLogged(true, "/05-mvc/connexion");

    if(empty($_GET["id"]))goToListe();

    $message = getMessageById((int)$_GET["id"]);

    if(!$message || $message["idUser"] != $_SESSION["idUser"])goToListe();

    $categories = getAllCategories();

    $error = $m = "";
    if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['editMessage']))
    {
        if(empty($_POST["message"]))
        {
            $error = "Veuillez entrer un message";
        }else{
            $m = cleanData($_POST["message"]);
        }
        
        if(empty($error)){
            if(empty($_POST["categorie"])){
                    updateMessageById($message["idMessage"], $m);       
            }else{
                $cat = getCategorieById((int)$_POST["categorie"]);
                if($cat){
                    updateMessageById($message["idMessage"], $m, $cat["idCat"]);
                }else{
                    $_SESSION["flash"] = "Cette catégorie n'exite pas.";
                    goToListe();
                }
            }
            $_SESSION["flash"] = "Message édité";
            goToListe();
        }
    }
    require __DIR__."/../view/messageFormateur/update.php";
}
function goToListe(): void{
    header("Location: /05-mvc/message/list?id=".$_SESSION["idUser"]);
    exit;
}
?>