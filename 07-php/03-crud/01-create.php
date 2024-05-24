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