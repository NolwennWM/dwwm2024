<?php
session_start([
    "cookie_lifetime"=>3600
]);
/* 
    Si l'utilisateur est déjà connecté, il ne devrait plus avoir accès à la page de connexion.
    Je vérifie donc si il est connecté en vérifiant si en session il y a la clef que j'ajouterais au moment de la connexion.

    Si elle est présente, je le redirige vers une autre page.
*/
if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)
{
    header("Location: /");
    exit;
}
$email = $pass = "";
$error = [];

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['login']))
{
    // Vérification email :
    if(empty($_POST["email"]))
    {
        $error["email"] = "Veuillez entrer un email";
    }
    else
    {
        $email = trim($_POST["email"]);
    }
    // Vérification mot de passe :
    if(empty($_POST["password"]))
    {
        $error["password"] = "Veuillez entrer un mot de passe";
    }
    else
    {
        $pass = trim($_POST["password"]);
    }  
    if(empty($error))
    {
        require "../../ressources/service/_pdo.php";
        $connexion = connexionPDO();

        $sql = $connexion->prepare("SELECT * FROM users WHERE email = :em");
        $sql->execute(["em"=>$email]);

        $user = $sql->fetch();

        if($user)
        {
            /* 
                Un mot de passe enregistré en bdd doit être haché, 
                Mais de nos jours, les méthodes de hachage génère un hachage différent à chaque tentative.
                On ne pourra donc pas vérifier l'exactitude de notre mot de passe avec "==="

                On n'utilisera pour cela la fonction password_verify
            */
            if(password_verify($pass, $user["password"]))
            {
                /* 
                    Si l'email et le mot de passe sont bon,
                    alors l'utilisateur est connecté,
                    Pour cela je sauvegarderais en session le fait qu'il est connecté.
                    Ainsi que les informations de l'utilisateur que je souhaite réutiliser sur les différentes pages de mon site.
                    Et si je le souhaite un temps d'expiration pour la connexion.
                */
                $_SESSION["logged"] = true;
                $_SESSION["username"] = $user["username"];
                $_SESSION["idUser"] = $user["idUser"];
                $_SESSION["expire"] = time()+3600;
                // Il ne me reste plus qu'à le redigé sur la page souhaité :
                header("Location: /");
                exit;
            }
            else
            {
                $error["login"] = "Mot de passe incorrecte";
            }
        }
        else
        {
            $error["login"] = "email incorrecte";
        }
    }  
}

$title = " Connexion ";
require("../../ressources/template/_header.php");
?>

<form action="" method="post">
    <label for="email">Email</label>
    <input type="email" name="email" id="email">
    <br>
    <span class="error"><?php echo $error["email"]??""; ?></span>
    <br>
    <label for="password">Mot de passe</label>
    <input type="password" name="password" id="password">
    <br>
    <span class="error"><?php echo $error["pass"]??""; ?></span>
    <br>
    <input type="submit" value="Connexion" name="login">
    <br>
    <span class="error"><?php echo $error["login"]??""; ?></span>
</form>
<?php
require("../../ressources/template/_footer.php");
?>