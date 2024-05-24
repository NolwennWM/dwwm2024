<?php
/* 
    CRUD signifie :
        Create
        Read
        Update
        Delete
    En règle général, chaque table de la BDD doit pouvoir être lu, se voir créer une donnée, être mis à jour et pouvoir supprimer une donnée.

    On ne doit pas pouvoir aller sur la page d'inscription si on est déjà connecté :
*/
require "../ressources/service/_shouldBeLogged.php";
shouldBeLogged(false, "./02-read.php");

$username = $email = $password = "";
$error = [];
$regexPass = "/^(?=.*[!?@#$%^&*+-])(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z]).{6,}$/";

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['inscription']))
{
    // On inclu notre service de connexion, et nos sécurités :
    require "../ressources/service/_pdo.php";
    require "../ressources/service/_csrf.php";

    $pdo = connexionPDO();

    // Traitement username :
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
    // Traitement email :
    if(empty($_POST["email"]))
    {
        $error["email"] = "Veuillez entrer un email";
    }
    else
    {
        $email = cleanData($_POST["email"]);
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error["email"] = "Veuillez saisir un email valide";
        }
        /* 
            Généralement les sites n'acceptent d'un seul email identique par compte.
            On va donc vérifier si l'email fourni existe déjà

            Lorsqu'une requête à la BDD doit contenir des informations entrées par l'utilisateur.
            On doit réaliser une requête préparé.
            Requête où l'on sépare le SQL des données à entrer.
            Données remplacés soit par un "?" soit par ":unMot"
        */
        $sql = $pdo->prepare("SELECT * FROM users WHERE email=:em");
        /* 
            Les données peuvent être fourni par la suite de plusieurs façons, l'une d'entre elle est de fournir un tableau à la méthode "execute"
        */
        $sql->execute(["em"=>$email]);
        /* 
            Enfin nous utilisons la méthode "fetch()" pour aller chercher la première ligne retourné par notre requête
        */
        $resultat = $sql->fetch();
        /* 
            Je vérifie si on a un résultat,
            Si c'est le cas, l'email est déjà en BDD, on indique alors une erreur
        */
        if($resultat)
        {
            $error["email"] = "Cet email est déjà enregistré";
        }
    }
    // Traitement password :
    if(empty($_POST["password"]))
    {
        $error["password"] = "Veuillez saisir un mot de passe";
    }
    else
    {
        $password = trim($_POST["password"]);
        if(!preg_match($regexPass, $password))
        {
            $error["password"] = "Veuillez saisir un mot de passe plus complexe";
        }
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    // Traitement Confirmation du mot de passe :
    if(empty($_POST["passwordBis"]))
    {
        $error["passwordBis"] = "Veuillez saisir à nouveau votre mot de passe.";
    }
    elseif($_POST["password"] != $_POST["passwordBis"])
    {
        $error["passwordBis"] = "Veuillez saisir le même mot de passe";
    }
    /* 
        Pour simplifier le cours, il manque deux éléments à ce formulaire :
            - CSRF
            - Captcha
    */
    if(empty($error))
    {
        $sql = $pdo->prepare("INSERT INTO users(username, email, password) VALUES(?,?,?)");
        /* 
            Si on choisi de faire notre requête préparé avec des "?"
            Il faut donner au tableau de execute, le même ordre que celui des points d'interrogations.

            Ici nous avons d'abbord, username, puis email, et enfin password
        */
        $sql->execute([$username, $email, $password]);
        /* 
            Enfin nous allons rediriger notre utilisateur vers une autre page.
            Souvent la page de connexion, mais nous ne l'avons pas encore.
        */
        header("Location: /");
        exit;
    }
}

$title = " CRUD - Create ";
require("../ressources/template/_header.php");
?>
<form action="" method="post">
    <!-- username -->
    <label for="username">Nom d'Utilisateur :</label>
    <input type="text" name="username" id="username" required>
    <span class="erreur"><?php echo $error["username"]??""; ?></span>
    <br>
    <!-- Email -->
    <label for="email">Adresse Email :</label>
    <input type="email" name="email" id="email" required>
    <span class="erreur"><?php echo $error["email"]??""; ?></span> 
    <br>
    <!-- Password -->
    <label for="password">Mot de passe :</label>
    <input type="password" name="password" id="password" required>
    <span class="erreur"><?php echo $error["password"]??""; ?></span> 
    <br>
    <!-- password verify -->
    <label for="passwordBis">Confirmation du mot de passe :</label>
    <input type="password" name="passwordBis" id="passwordBis" required>
    <span class="erreur"><?php echo $error["passwordBis"]??""; ?></span> 
    <br>

    <input type="submit" value="Inscription" name="inscription">
</form>
<?php 
/* 
    Pour des raisons de simplicité du cours, on n'a pas mit de securité
    sur ce formulaire, mais pensez à en ajouter sur vos projets.
*/
require("../ressources/template/_footer.php");
?>