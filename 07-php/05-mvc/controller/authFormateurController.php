<?php 
require __DIR__."/../../ressources/service/_shouldBeLogged.php";
// require(__DIR__."/../model/userModel.php");
require(__DIR__."/../model/userMongoModel.php");

function login()
{
    shouldBeLogged(false, "/05-mvc");
    $email = $pass = "";
    $error = [];
    
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])){
        if(empty($_POST["email"])){
            $error["email"] = "Veuillez entrer un email.";
        }else{
            $email = trim($_POST["email"]);
        }
        if(empty($_POST["password"])){
            $error["pass"] = "Veuillez entrer un mot de passe.";
        }else{
            $pass = trim($_POST["password"]);
        }
        if(empty($error)){
            // Je récupère l 'utilisateur correspondant à l'email.
            $user = getOneUserByEmail($email);
            if($user){
                if(password_verify($pass, $user["password"])){
                    $_SESSION["logged"] = true; 
                    $_SESSION["username"] = $user["username"];
                    $_SESSION["idUser"] = $user["idUser"];
                    $_SESSION["expire"] = time()+ (60*60);
                    header("location: /05-mvc");
                    exit;
                }
                else{
                    $error["login"] = "Email ou Mot de passe incorrecte.";
                }
            }
            else{
                $error["login"] = "Email ou Mot de passe incorrecte.";
            }
        }
    }
    require __DIR__."/../view/authFormateur/connexion.php";
}
function logout()
{
    shouldBeLogged(true, "/05-mvc/connexion");
    unset($_SESSION);
    session_destroy();
    setcookie("PHPSESSID","", time()-3600);
    header("location: /05-mvc/connexion");
    exit;
}
?>