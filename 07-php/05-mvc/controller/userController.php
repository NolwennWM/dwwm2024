<?php 
require __DIR__."/../../ressources/service/_shouldBeLogged.php";
require __DIR__."/../../ressources/service/_csrf.php";
require __DIR__."/../model/userModel.php";
/**
 * Gère la page d'inscription
 *
 * @return void
 */
function createUser(){}
/**
 * Gère la page "liste des utilisateurs"
 *
 * @return void
 */
function readUsers()
{
    // je récupère tous mes utilisateurs
    $users = getAllUsers();
    // Je vérifie l'existence de message flash
    if(isset($_SESSION["flash"]))
    {
        $flash = $_SESSION["flash"];
        unset($_SESSION["flash"]);
    }
    // J'inclu ma vue 
    require __DIR__."/../view/user/list.php";
}
/**
 * Gère la page "mise à jour de l'utilisateur"
 *
 * @return void
 */
function updateUser(){}
/**
 * Gère la page "suppression de l'utilisateur"
 *
 * @return void
 */
function deleteUser()
{
    shouldBeLogged(true, "/05-mvc");
    // On vérifie que l'id en get correspond à celui de l'utilisateur connecté
    if(empty($_GET["id"]) || $_SESSION["idUser"] != $_GET["id"])
    {
        header("Location: /05-mvc");
        exit;
    }
    // On supprime l'utilisateur :
    deleteUserById((int)$_GET["id"]);
    // On déconnecte l'utilisateur
    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID", "", time()-3600);
    // Je le redirige après quelques secondes
    header("refresh: 5;url = /05-mvc");
    // J'inclu la vue 
    require __DIR__. "/../view/user/delete.php";
}