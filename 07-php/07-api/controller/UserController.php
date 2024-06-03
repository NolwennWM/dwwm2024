<?php 
// Quels sont les méthodes acceptés par cette page :
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
session_start();

require __DIR__."/../model/userModel.php";
require __DIR__."/../../ressources/service/_csrf.php";

$regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";
/* 
    Pour une même adresse, selon la méthode utilisé pour la requête, 
    J'obtiendrais différents résultats.
*/
switch($_SERVER["REQUEST_METHOD"])
{
    case "POST":  create(); break;
    case "GET": read(); break;
    case "PUT": update(); break;
    case "DELETE": delete(); break;
}

function create(): void
{
    // Pour récupérer des données JSON envoyé dans le corps de la requête :
    $json = file_get_contents("php://input");
    $data = json_decode($json);

    $username = $email = $password = "";
    $error = setError();

    if(!empty($data))
    {
        // traitement username :
        if(empty($data->username))
        {
            setError("username", "Veuillez saisir un nom d'utilisateur");
        }
        else
        {
            $username = cleanData($data->username);
            if(!preg_match("/^[a-zA-Z'\s-]{2,25}$/", $username))
            {
                setError("username", "Veuillez saisir un nom d'utilisateur valide");
            }
        }
        // traitement email :
        if(empty($data->email))
        {
            setError("email", "Veuillez saisir un email");
        }
        else
        {
            $email = cleanData($data->email);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                setError("email", "Veuillez saisir un email valide");
            }
            $resultat = getOneUserByEmail($email);
            if($resultat)
            {
                setError("email", "Cet email est déjà enregistré");
            }
        }
        // traitement du mot de passe :
        if(empty($data->password))
        {
            setError("password", "Veuillez saisir un mot de passe");
        }
        else
        {
            $password = trim($data->password);
            global $regexPass;
            if(!preg_match($regexPass, $password))
            {
                setError("password", "Veuillez saisir un mot de passe plus complexe");
            }else
            {
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
        }
        // traitement confirmation mdp
        if(empty($data->passwordBis))
        {
            setError("passwordBis", "Veuillez saisir à nouveau votre mot de passe");
        }
        elseif($data->password != $data->passwordBis)
        {
            setError("passwordBis", "Veuillez saisir le même mot de passe");
        }
        $error = setError();
        if(empty($error["violations"]))
        {
            addUser($username, $email, $password);
            sendResponse([], 201, "Inscription Validé");
        }
    }
    sendResponse($error, 400, "Formulaire Incorrecte");
}
function read(): void
{
    if(empty($_GET["id"]))
    {
        $users = getAllUsers();
    }
    else
    {
        $users = getOneUserById((int)$_GET["id"]);
    }
    sendResponse($users, 200, "Utilisateur(s) récupéré(s)");
}
function update(): void
{
    if(!isset($_GET["id"], $_SESSION["idUser"]) || $_SESSION["idUser"] != $_GET["id"])
    {
        sendResponse([], 401, "Accès Interdit !");
    }
    $user = getOneUserById((int)$_GET["id"]);

    $json = file_get_contents("php://input");
    $data = json_decode($json);

    $username = $password = $email = "";
    $error = setError();

    if(!empty($data))
    {
        // traitement username :
        if(empty($data->username))
        {
            $username = $user["username"];
        }
        else
        {
            $username = cleanData($data->username);
            if(!preg_match("/^[a-zA-Z'\s-]{2,25}$/", $username))
            {
                setError("username", "Votre nom d'utilisateur contient des caractères interdits");
            }
        }
        // traitement email :
        if(empty($data->email) || $data->email == $user["email"])
        {
            $email = $user["email"];
        }
        else
        {
            $email = cleanData($data->email);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                setError("email", "Veuillez entrer un email valide");
            }
            $exist = getOneUserByEmail($email);
            if($exist)
            {
                setError("email", "Cet email est déjà enregistré");
            }
        }
        // traitement mdp
        if(empty($data->password))
        {
            $password = $user["password"];
        }
        else
        {
            if(empty($data->passwordBis))
            {
                setError("passwordBis", "Veuillez saisir à nouveau votre mot de passe");
            }elseif($data->password != $data->passwordBis)
            {
                setError("passwordBis", "Veuillez saisir à nouveau votre mot de passe");
            }
            $password = trim($data->password);
            global $regexPass;
            if(!preg_match($regexPass, $password))
            {
                setError("password", "Veuillez saisir un mot de passe plus complexe");
            }
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
        $error = setError();
        if(empty($error["violations"]))
        {
            updateUserById($username, $email, $password, $user["idUser"]);
            sendResponse([], 204, "Utilisateur mis à jour");
        }
    }

    sendResponse($error, 400, "Formulaire incorrecte");
}
function delete(): void
{
    if(!isset($_GET["id"], $_SESSION["idUser"]) || $_SESSION["idUser"] != $_GET["id"])
    {
        sendResponse([], 401, "Accès Interdit !");
    }
    
    deleteUserById((int)$_GET["id"]);

    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID", "", time()-3600);

    sendResponse([], 204, "Compte supprimé et déconnecté");
}
?>