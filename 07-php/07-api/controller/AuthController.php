<?php
header("Access-Control-Allow-Methods: POST, GET");
session_start();

require __DIR__."/../model/userModel.php";

switch($_SERVER["REQUEST_METHOD"])
{
    case "POST": login(); break;
    case "GET": logout(); break;
}
function login()
{
    $email = $pass = "";
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if(!empty($data)){
        if(empty($data->email)){
            setError("email","Veuillez entrer un email.");
        }else{
            $email = trim($data->email);
        }
        if(empty($data->password)){
            setError("password","Veuillez entrer un mot de passe.");
        }else{
            $pass = trim($data->password);
        }
        
        $error = setError();
        if(empty($error["violations"])){
            // Je récupère l 'utilisateur correspondant à l'email.
            $user = getOneUserByEmail($email);
            if($user){
                if(password_verify($pass, $user["password"])){
                    $_SESSION["logged"] = true; 
                    $_SESSION["idUser"] = $user["idUser"];
                    sendResponse($user, 200, "Utilisateur connecté");
                }
            }
            setError("login","Email ou Mot de passe incorrecte.");
        }
    }
	$error = setError();
    sendResponse($error, 400, "Formulaire incorrecte");
}

function logout()
{
    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID","", time()-3600);
    sendResponse([], 200, "Utilisateur déconnecté");
}
?>