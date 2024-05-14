<?php
/* 
    Quelques conventions :
        1. Quand on place toute notre logique PHP dans le même fichier que notre HTML,
        On placera souvent toute la logique en haut du fichier, avant le HTML.
        2. On aura tendance à déclarer toute les variables que l'on va utiliser en haut de notre code, afin de s'en souvenir et de pouvoir les modifier sans avoir à les chercher.
*/
$username = $food = $drink = "";
$error = [];
# La liste des boissons et repas selectionnable :
$foodList = ["welsh", "cannelloni", "oyakodon"];
$drinkList = ["jus de tomate", "milkshake", "limonade"];

/* 
    Lorsque l'on traite un formulaire, la première chose à vérifier, 
    est que l'on a bien la méthode attendue (get, post...)
    Pour cela on utilisera la super globale "$_SERVER" avec la clef "REQUEST_METHOD"
    ! Attention, la méthode est donnée en majuscule

    La méthode "get" étant aussi celle que l'on utilise pour aller sur notre page par défaut, c'est simple vérification n'est pas suffisante.
    Je pourrais aussi vérifier qu'un de mes champs est aussi envoyé ou alors ajouter un "name" à mon bouton d'envoi par exemple.

    Pour vérifier l'existence d'une donnée envoyé en get je pourrais utiliser la superglobal "$_GET"
*/
if($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["meal"]))
{
    # Vérification du champ username :
    if(empty($_GET["username"]))
    {
        // Si mon champ "username" est vide, je prépare un message d'erreur
        $error["username"] = "Veuillez entrer un nom d'utilisateur";
    }
    else
    {
        // Si j'ai bien un nom d'utilisateur, je vais traiter la donnée :
        $username = $_GET["username"];
        /* 
            L'utilisation de htmlspecialchars ou htmlentities évitera les attaques XSS
        */
        $username = htmlspecialchars($username);
        # par défaut, trim retire les espaces avant et après le string
        $username = trim($username);
        # retire les "\" présents dans le string
        $username = stripslashes($username);
        // Ensuite nous allons faire toute les vérifications que l'on souhaite imposer au nom d'utilisateur:
        if(strlen($username) < 3 || strlen($username) > 255)
        {
            $error["username"] = "Votre nom d'utilisateur n'a pas une taille adapté";
        }
        // Si on souhaite le faire passer par une regex, on utilisera :
        if(!preg_match("/^[a-zA-Z'\s-]*$/", $username))
        {
            $error["username"] = "Votre nom contient des characters illicite";
        }
    } # fin vérification username
    // vérification du champ food
    if(empty($_GET["food"]))
    {
        $error["food"] = "Veuillez choisir un repas !";
    }
    else
    {
        $food = $_GET["food"];
        // si la donnée envoyé ne correspond pas à ma liste, je provoque une erreur.
        if(!in_array($food, $foodList))
        {
            $error["food"] = "Ce repas n'existe pas !";
        }
    }# fin vérification food
    // vérification du champ drink
    if(empty($_GET["drink"]))
    {
        $error["drink"] = "Veuillez choisir une boisson !";
    }
    else
    {
        $drink = $_GET["drink"];
        if(!in_array($drink, $drinkList))
        {
            $error["drink"] = "Cette boisson n'existe pas !";
        }
    }# fin vérification drink

    /* 
        Une fois tous les champs vérifiés
        On peut vérifier qu'aucune erreur n'a été détecté :
    */
    if(empty($error))
    {
        /* 
            On pourrait envoyer les données en BDD ici
            mais on verra cela dans un prochain cours.
        */
    }
}

$title = " GET ";
require("../ressources/template/_header.php");
?>
<form action="" method="GET">
    <input type="text" placeholder="Entrez un nom" name="username">
    <!-- les span.error serviront à afficher les messages d'erreur. -->
    <span class="error"><?php echo $error["username"]??"" ?></span>
    <br>
    <fieldset>
        <legend>Nourriture favorite</legend>
        <input type="radio" name="food" id="welsh" value="welsh"> 
        <label for="welsh">Welsh (car vive le fromage)</label>
        <br>
        <input type="radio" name="food" id="cannelloni" value="cannelloni"> 
        <label for="cannelloni">Cannelloni (car les ravioli c'est surfait)</label>
        <br>
        <input type="radio" name="food" id="oyakodon" value="oyakodon"> 
        <label for="oyakodon">Oyakodon (car j'aime l'humour noir)</label>
        <span class="error"><?= $error["food"]??"" ?></span>
    </fieldset>
    <label for="boisson">Boisson favorite</label>
    <br>
    <select name="drink" id="boisson">
        <option value="jus de tomate">jus de tomate (je suis un vampire)</option>
        <option value="milkshake">Milkshake (aux fruits de préférence)</option>
        <option value="limonade">Limonade (J'ai besoin de sucre)</option>
    </select>
    <span class="error"><?= $error["drink"]??"" ?></span>
    <br>

    <input type="submit" value="Envoyer" name="meal">
</form>
<?php if(empty($error) && isset($_GET["meal"])):?>
    <h2>Meilleurs repas :</h2>
    <p>
        <?php echo "Pour $username, le meilleur repas est \"$food\" avec \"$drink\"";?>
    </p>
<?php 
endif;
require("../ressources/template/_footer.php");
?>