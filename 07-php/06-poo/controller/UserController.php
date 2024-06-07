<?php 
use Model\UserModel;
use Classes\AbstractController;
use Classes\Interface\CrudInterface;

require __DIR__."/../../ressources/service/_shouldBeLogged.php";
require __DIR__."/../../ressources/service/_csrf.php";

class UserController extends AbstractController implements CrudInterface
{
    use Classes\Trait\Debug;

    private UserModel $db;
    private string $regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

    function __construct()
    {
        $this->db = new UserModel();
    }

    function create()
    {
        shouldBeLogged(false, "/06-poo");
        $username = $email = $password = "";
        $error = [];

        if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['userForm']))
        {
            // traitement username
            if(empty($_POST["username"]))
            {
                $error["username"] = "Veuillez saisir un nom d'utilisateur";
            }else
            {
                $username = cleanData($_POST["username"]);
                if(!preg_match("/^[a-zA-Z'\s-]{2,25}$/", $username))
                {
                    $error["username"] = "Veuillez saisir un nom d'utilisateur valide";
                }
            }
            // traitement email :
            if(empty($_POST["email"]))
            {
                $error["email"] = "Veuillez saisir un email";
            }else
            {
                $email = cleanData($_POST["email"]);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $error["email"]= "Veuillez saisir un email valide";
                }
                $resultat = $this->db->getOneUserByEmail($email);
                if($resultat)
                {
                    $error["email"] = "Cet email existe déjà";
                }
            }
            // Traitement password
            if(empty($_POST["password"]))
            {
                $error["password"] = "Veuillez saisir un mot de passe";
            }
            else
            {
                $password = trim($_POST["password"]);
                if(!preg_match($this->regexPass, $password))
                {
                    $error["password"] = "Veuillez saisir un mot de passe plus complexe";
                }
                $password = password_hash($password, PASSWORD_DEFAULT);
            }
            // traitement confirmation password
            if(empty($_POST["passwordBis"]))
            {
                $error["passwordBis"] = "Veuillez confirmer votre mot de passe";
            }
            elseif($_POST["passwordBis"] != $_POST["password"])
            {
                $error["passwordBis"]="Veuillez saisir le même mot de passe";
            }
            // envoi des données
            if(empty($error))
            {
                $this->db->addUser($username, $email, $password);
                $this->setFlash("Inscription validée");
                header("Location: /06-poo");
                exit;
            }
        }
        $this->render("user/inscription.php",[
            "error"=>$error,
            "title"=>"POO - Inscription",
            "required"=>"required"
        ]);
    }
    function read()
    {
        $users = $this->db->getAllUsers();
        // $this->dump($users);
        $this->render("user/list.php", [
            "users"=>$users,
            "title"=> "POO - Liste Utilisateur"
        ]);
    }
    function update()
    {
        shouldBeLogged(true, "/06-poo/connexion");

        if(empty($_GET["id"]) || $_SESSION["idUser"] != $_GET["id"])
        {
            // Je change la redirection
            header("Location: /06-poo");
            exit;
        }

        // Je change la fonction en méthode
        $user = $this->db->getOneUserById((int)$_GET["id"]);

        $username = $password = $email = "";
        $error = [];
        // Je retire $regexPass et modifie le nom du formulaire
        if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["userForm"]))
        {
            if(empty($_POST["username"]))
                $username = $user["username"];
            else
            {
                $username = cleanData($_POST["username"]);
                if(!preg_match("/^[a-zA-Z'\s-]{2,25}$/", $username))
                    $error["username"]= "Votre nom d'utilisateur ne peut contenir que des lettres";
            }
            if(empty($_POST["email"]) || $_POST["email"] == $user["email"])
                $email = $user["email"];
            else
            {
                $email = cleanData($_POST["email"]);
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                    $error["email"]= "Votre nom d'utilisateur ne peut contenir que des lettres";
                
                $exist = $this->db->getOneUserByEmail($email);
                if($exist)
                {
                    $error["email"] = "Cet email existe déjà";
                }
            }
            if(empty($_POST["password"]))
                $password = $user["password"];
            else
            {
                $password = trim($_POST["password"]);
                if(empty($_POST["passwordBis"]))
                {
                    $error["passwordBis"] = "Veuillez confirmer votre mot de passe";
                }
                elseif($_POST["password"] != $_POST["passwordBis"])
                {
                    $error["passwordBis"] = "Veuillez saisir le même mot de passe";
                }
                // Je change la variable en propriété
                if(!preg_match($this->regexPass, $password))
                {
                    $error["password"] = "Veuillez saisir un mot de passe valide";
                }
                else
                    $password = password_hash($password, PASSWORD_DEFAULT);
            }
            if(empty($error))
            {
                // Je change la fonction en méthode
                $this->db->updateUserById($username, $email, $password, $user["idUser"]);

                // J'utilise ma méthode pour flash message;
                $this->setFlash("Votre Profil a bien été édité.");
                // Je change ma redirection
                header("Location: /06-poo");
                exit;
            }
        }
        // J'inclu ma vue.
        $this->render("user/update.php", [
            "error"=>$error,
            "user"=>$user,
            "title"=>"POO - Mise à jour du Profil"
        ]);
    }
    function delete()
    {
        shouldBeLogged(true, "/06-poo/connexion");

        if(empty($_GET["id"]) || $_SESSION["idUser"] != $_GET["id"])
        {
            // Je change la redirection
            header("Location: /06-poo");
            exit;
        }

        $this->db->deleteUserById((int)$_GET["id"]);

        unset($_SESSION);
        session_destroy();
        setcookie("PHPSESSID", "", time()-3600);

        header("refresh: 5;url = /06-poo");

        $this->render("user/delete.php", ["title"=>"POO - Suppression de compte"]);
    }
}
?>