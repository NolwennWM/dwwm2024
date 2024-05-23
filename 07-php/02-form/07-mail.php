<?php
$title = " Email ";
require("../ressources/template/_header.php");
?>
<form action="" method="post">
    <input type="email" name="email" placeholder="Votre email">
    <span class="error"><?php echo $error["email"]??"" ?></span>
    <br>
    <input type="text" name="sujet" placeholder="Sujet de votre message">
    <span class="error"><?php echo $error["sujet"]??"" ?></span>
    <br>
    <textarea name="corps" cols="30" rows="10" placeholder="Votre message"></textarea>
    <span class="error"><?php echo $error["corps"]??"" ?></span>
    <br>
    <div>
        <label for="captcha">Veuillez recoppier le texte ci-dessous pour valider :</label>
        <br>
        <img src="../ressources/service/_captcha.php" alt="CAPTCHA">
        <br>
        <input type="text" id="captcha" name="captcha" pattern="[A-Z0-9]{6}">
    <span class="error"><?php echo $error["captcha"]??"" ?></span>
    </div>
    <input type="submit" value="Envoyer" name="contact">
</form>
<?php
require("../ressources/template/_footer.php");
?>