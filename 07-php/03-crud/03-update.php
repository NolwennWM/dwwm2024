<?php
// Si on n'est pas connecté, on est redirigé vers une autre page
require "../ressources/service/_shouldBeLogged.php";
shouldBeLogged(true, "./exercice/connexion.php");

// Si l'utilisateur connecté est différent de l'utilisateur qu'on tente de modifier, alors on le redirige.
if(!isset($_SESSION["idUser"], $_GET["id"]) || $_SESSION["idUser"] != $_GET["id"])
{
    header("Location: ./02-read.php");
    exit;
}

// On récupère les informations de notre utilisateur :
require "../ressources/service/_pdo.php";
$connexion = connexionPDO();
$sql = $connexion->prepare("SELECT * FROM users WHERE idUser=:id");
$sql->execute(["id"=>(int)$_GET["id"]]);
$user = $sql->fetch();

// On traite le formulaire :
$username = $password = $email = "";
$error = [];
$regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['update']))
{
    require "../ressources/service/_csrf.php";
    // Si le nom d'utilisateur est vide, je laisse celui en BDD
    if(empty($_POST["username"]))
    {
        $username = $user["username"];
    }else
    {
        $username = cleanData($_POST["username"]);
        if(!preg_match("/^[a-zA-Z'\s-]{2,25}$/", $username))
        {
            $error["username"]= "Votre nom d'utilisateur n'est pas valide";
        }
    }
    // Si l'email est vide, ou pas changé, on garde celui en BDD
    if(empty($_POST["email"]) || $_POST["email"] === $user["email"])
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
        $sql = $connexion->prepare("SELECT * FROM users WHERE email = ?");
        $sql->execute([$email]);
        $exist = $sql->fetch();
        if($exist)
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
        $password = trim($_POST["password"]);
        // On ne vérifie la confirmation du mot de passe, que si l'utilisateur a voulu entrer un nouveau mot de passe.
        if(empty($_POST["passwordBis"]))
        {
            $error["passwordBis"] = "Veuillez confirmer votre mot de passe";
        }
        elseif($_POST["password"] != $_POST["passwordBis"])
        {
            $error["passwordBis"] = "Veuillez saisir le même mot de passe";
        }
        if(!preg_match($regexPass, $password))
        {
            $error["password"] = "Veuillez choisir un mot de passe plus complexe";
        }
        else
        {
            $password = password_hash($password, PASSWORD_DEFAULT);
        }
    }
    // Si aucune erreur, on met à jour la BDD
    if(empty($error))
    {
        $sql = $connexion->prepare("UPDATE users SET username=?, password = ?, email = ? WHERE idUser = ?");
        $sql->execute([$username, $password, $email, $user["idUser"]]);
        // Ajout d'un message flash :
        $_SESSION["flash"] = "Votre profil a bien été édité";
        header("Location: ./02-read.php");
        exit;
    }
}

$title = " CRUD - Update ";
require("../ressources/template/_header.php");
if($user):
?>
<form action="" method="post">
    <!-- username -->
    <label for="username">Nom d'Utilisateur :</label>
    <input type="text" name="username" id="username" value="<?php echo $user["username"] ?>">
    <span class="erreur"><?php echo $error["username"]??""; ?></span>
    <br>
    <!-- Email -->
    <label for="email">Adresse Email :</label>
    <input type="email" name="email" id="email" value="<?php echo $user["email"] ?>">
    <span class="erreur"><?php echo $error["email"]??""; ?></span> 
    <br>
    <!-- Password -->
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password">
    <span class="erreur"><?php echo $error["password"]??""; ?></span> 
    <br>
    <!-- password verify -->
    <label for="passwordBis">Confirmation du mot de passe :</label>
    <input type="password" name="passwordBis" id="passwordBis">
    <span class="erreur"><?php echo $error["passwordBis"]??""; ?></span> 
    <br>

    <input type="submit" value="Mettre à jour" name="update">
</form>
<?php else: ?>
    <p>Aucun Utilisateur trouvé</p>
<?php 
endif;
require("../ressources/template/_footer.php");
?>