<?php 
require __DIR__."/../../ressources/service/_shouldBeLogged.php";
require __DIR__."/../../ressources/service/_csrf.php";
// require __DIR__."/../model/userModel.php";
require __DIR__."/../model/userMongoModel.php";
/**
 * Gère la page d'inscription
 *
 * @return void
 */
function createUser()
{
    shouldBeLogged(false, "/05-mvc");

    $username = $email = $password = "";
    $error = [];
    $regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['inscription']))
    {
        // traitement username 
        if(empty($_POST["username"]))
        {
            $error["username"] = "Veuillez saisir un nom d'utilisateur";
        }
        else
        {
            $username = cleanData($_POST["username"]);
            if(!preg_match("/^[a-zA-Z'\s-]{2,25}$/", $username))
            {
                $error["username"] = "Veuillez saisir un nom d'utilisateur valide";
            }
        }
        // Traitement de l'email
        if(empty($_POST["email"]))
        {
            $error["email"] = "Veuillez saisir un email";
        }
        else
        {
            $email = cleanData($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $error["email"] = "Veuillez saisir un email valide";
            }
            // On vérifie si l'email est déjà enregistré
            $resultat = getOneUserByEmail($email);
            if($resultat)
            {
                $error["email"] = "Cet email est déjà enregistré";
            }
        }
        // traitement du mot de passe :
        if(empty($_POST["password"]))
        {
            $error["password"] = "Veuillez saisir un mot de passe";
        }
        else
        {
            $password = trim($_POST["password"]);
            if(!preg_match($regexPass,$password))
            {
                $error["password"] = "Veuillez saisir un mot de passe plus complexe";
            }
            else
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
        }
        // traitement de la confirmation du mot de passe
        if(empty($_POST["passwordBis"]))
        {
            $error["passwordBis"] = "Veuillez saisir à nouveau votre mot de passe";
        }
        elseif($_POST["password"] != $_POST["passwordBis"])
        {
            $error["passwordBis"] = "Veuillez saisir le même mot de passe";
        }

        if(empty($error))
        {
            // On ajoute l'utilisateur en BDD
            addUser($username, $email, $password);
            header("Location: /05-mvc");
            exit;
        }
    }   // fin traitement formulaire
    // Inclure la vue :
    require __DIR__ ."/../view/user/inscription.php";
}
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
function updateUser()
{
    shouldBeLogged(true, "/05-mvc");
    // On vérifie que l'id en get correspond à celui de l'utilisateur connecté
    if(empty($_GET["id"]) || $_SESSION["idUser"] != $_GET["id"])
    {
        header("Location: /05-mvc");
        exit;
    }
    // Je récupère les informations de mon utilisateur
    $user = getOneUserById($_GET["id"]);

    $username = $password = $email = "";
    $error = [];
    $regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['update']))
    {
        // traitement de l'username
        if(empty($_POST["username"]))
        {
            $username = $user["username"];
        }
        else
        {
            $username = cleanData($_POST["username"]);
            if(!preg_match("/^[a-zA-Z'\s-]{2,25}$/", $username))
            {
                $error["username"] = "Votre nom d'utilisateur n'est pas valide";
            }
        }
        // traitement de l'email
        if(empty($_POST["email"]) || $_POST["email"] == $user["email"])
        {
            $email = $user["email"];
        }
        else
        {
            $email = cleanData($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $error["email"] = "Veuillez entrer un email valide";
            }
            $resultat = getOneUserByEmail($email);
            if($resultat)
            {
                $error["email"] = "Cet email existe déjà";
            }
        }
        // traitement du mot de passe :
        if(empty($_POST["password"]))
        {
            $password = $user["password"];
        }
        else
        {
            if(empty($_POST["passwordBis"]))
            {
                $error["passwordBis"] = "Veuillez saisir à nouveau votre mot de passe";
            }
            elseif($_POST["password"] != $_POST["passwordBis"])
            {
                $error["passwordBis"] = "Veuillez saisir le même mot de passe";
            }
            $password = trim($_POST["password"]);
            if(!preg_match($regexPass, $password))
            {
                $error["password"] = "Veuillez saisir un mot de passe plus complexe";
            }
            else
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
        }
        // envoi des données :
        if(empty($error))
        {
            // mis à jour de l'utilisateur
            updateUserById($username, $email, $password, $user["idUser"]);
            // message flash:
            $_SESSION["flash"] = "Votre profil a bien été édité";
            header("Location: /05-mvc");
            exit;
        }
    }// fin traitement formulaire
    // J'inclu la vue:
    require __DIR__."/../view/user/update.php";
}
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
    deleteUserById($_GET["id"]);
    // On déconnecte l'utilisateur
    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID", "", time()-3600);
    // Je le redirige après quelques secondes
    header("refresh: 5;url = /05-mvc");
    // J'inclu la vue 
    require __DIR__. "/../view/user/delete.php";
}