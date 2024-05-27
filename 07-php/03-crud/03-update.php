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

require "../ressources/service/_pdo.php";
$connexion = connexionPDO();
$sql = $connexion->prepare("SELECT * FROM users WHERE idUser=:id");
$sql->execute(["id"=>(int)$_GET["id"]]);
$user = $sql->fetch();

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