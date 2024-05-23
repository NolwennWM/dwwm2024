<?php
session_start();
require "../ressources/service/_mailer.php";
require "../ressources/service/_csrf.php";

$email = $subject = $body = $envoi = "";
$error = [];

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['contact']))
{
    if(empty($_POST["email"]))
    {
        $error["email"] = "Veuillez entrer un email";
    }
    else
    {
        $email = cleanData($_POST["email"]);
        /* 
            filter_var permet de filtrer la variable en premier argument.
            Elle peut au choix retourner un boolean 
            ou un string nettoyé
            Cela dépend du second argument.
            Une constante avec "VALIDATE" retournera un boolean
            Une constante avec "SANITIZE" retournera une valeur
        */
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $error["email"] = "Veuillez entrer un email valide";
        }
    }

    // Traitement du champ sujet
    if(empty($_POST["sujet"])) $error["sujet"] = "Veuillez entrer un sujet";
    else $subject = cleanData($_POST["sujet"]);

    // Traitement du champ corps
    if(empty($_POST["corps"])) $error["corps"] = "Veuillez entrer un message";
    else $body = cleanData($_POST["corps"]);

    // Traitement du CAPTCHA
    if(!isset($_POST["captcha"], $_SESSION["captchaStr"]) || $_POST["captcha"] != $_SESSION["captchaStr"])
    {
        $error["captcha"] = "Captcha Incorrecte !";
    }
    // Envoi du message :
    if(empty($error))
    {
        $envoi = sendMail(
            $email,
            "cours@nolwenn.fr",
            $subject,
            $body
        );
    }
}

$title = " Email ";
require("../ressources/template/_header.php");
if($envoi):
?>
    <p><?= $envoi ?></p>
<?php endif;?>
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