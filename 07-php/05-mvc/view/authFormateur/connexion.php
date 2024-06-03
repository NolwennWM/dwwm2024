<?php
$title = " MVC - connexion";
require(__DIR__."/../../../ressources/template/_header.php");
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
require(__DIR__."/../../../ressources/template/_footer.php");
?>