<?php
/* 
    Les seules différences entre un formulaire en GET et en POST est que l'on va récupérer les données du formulaire via "$_POST"
    que notre formulaire aura en attribut "method" la valeur "post"
    Et que l'on vérifiera avant la vérification que l'on arrive bien en méthode "POST"

    Comme ce cours serait déjà fini si on s'arrêtait là, améliorons un peu notre formulaire :
        1. On va transformer nos tableaux de données en tableau associatif.
        2. faire apparaître nos options et radio avec une boucle.
        3. ajouter une classe "formError" à certaines de nos balises.
        4. ajouter une case à cocher pour valider le formulaire.
        5. faire que nos utilisateurs n'ai pas à remplir à nouveau les champs en cas d'erreur.
*/
$username = $food = $drink = "";
$error = [];
# La liste des boissons et repas selectionnable :
$foodList = [
    "welsh"=> "Welsh (car vive le fromage)", 
    "cannelloni"=> "Cannelloni (car les raviolis c'est surfait)", 
    "oyakodon"=> "Oyakodon (car j'aime l'humour noir)"
];
$drinkList = [
    "jus de tomate"=>"Jus de Tomate (pour les vampires)", 
    "milkshake"=>"Milkshake (aux fruits de préférence)", 
    "limonade"=>"Limonade (J'ai besoin de sucre)"
];


if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["meal"]))
{
    # Vérification du champ username :
    if(empty($_POST["username"]))
    {
        // Si mon champ "username" est vide, je prépare un message d'erreur
        $error["username"] = "Veuillez entrer un nom d'utilisateur";
    }
    else
    {
        // Si j'ai bien un nom d'utilisateur, je vais traiter la donnée :
        $username = $_POST["username"];
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
    if(empty($_POST["food"]))
    {
        $error["food"] = "Veuillez choisir un repas !";
    }
    else
    {
        $food = $_POST["food"];
        /* 
            On change "in_array" par "array_key_exists" 
            car nous voulons vérifier les clefs de nos tableaux associatifs.
        */
        if(!array_key_exists($food, $foodList))
        {
            $error["food"] = "Ce repas n'existe pas !";
        }
    }# fin vérification food
    // vérification du champ drink
    if(empty($_POST["drink"]))
    {
        $error["drink"] = "Veuillez choisir une boisson !";
    }
    else
    {
        $drink = $_POST["drink"];
        if(!array_key_exists($drink, $drinkList))
        {
            $error["drink"] = "Cette boisson n'existe pas !";
        }
    }# fin vérification drink
    // Vériciation des conditions d'utilisation :
    if(empty($_POST["cgu"]))
    {
        $error["cgu"]= "Veuillez accepter nos conditions d'utilisation";
    }

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

$title = " POST ";
require("../ressources/template/_header.php");
?>
<form action="" method="POST">
    <input 
        type="text" 
        placeholder="Entrez un nom" 
        name="username"
        class="<?= empty($error["username"])?"":"formError" ?>"
        value="<?= $username ?>"
        >
    <!-- les span.error serviront à afficher les messages d'erreur. -->
    <span class="error"><?php echo $error["username"]??"" ?></span>
    <br>
    <fieldset>
        <legend>Nourriture favorite</legend>
        <?php foreach($foodList as $key => $value):?>
            <input 
                type="radio"
                name="food"
                id="<?= $key ?>"
                value="<?= $key ?>"
                <?= $food === $key?"checked":"" ?>
                >
            <label for="<?= $key ?>">
                <?= $value ?>
            </label>
            <br>
        <?php endforeach; ?>
        <span class="error"><?= $error["food"]??"" ?></span>
    </fieldset>
    <label for="boisson">Boisson favorite</label>
    <br>
    <select name="drink" id="boisson">
        <?php foreach($drinkList as $clef => $text):?>
            <option value="<?= $clef ?>" <?= $drink === $clef?"selected":""; ?>>
                <?= $text ?>
            </option>
        <?php endforeach; ?>
    </select>
    <span class="error"><?= $error["drink"]??"" ?></span>
    <br>
    <!-- On ajoute une case à cocher -->
    <input type="checkbox" name="cgu" id="cgu">
    <label for="cgu">J'accepte de vendre mon âme</label>
    <span class="error"><?php echo $error["cgu"]??"" ?></span>
    <br>
    <input type="submit" value="Envoyer" name="meal">
</form>
<?php if(empty($error) && isset($_POST["meal"])):?>
    <h2>Meilleurs repas :</h2>
    <p>
        <?php echo "Pour $username, le meilleur repas est \"$food\" avec \"$drink\"";?>
    </p>
<?php 
endif;
require("../ressources/template/_footer.php");
?>