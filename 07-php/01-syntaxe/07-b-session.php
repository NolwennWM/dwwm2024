<?php 
    /* 
        Dans une application complexe, il est possible de faire l'erreur d'avoir plusieurs "session_start()";

        Une notice apparaît alors et nous indique que le second "session_start()" a été ignoré.

        Pour éviter cela, on peut conditionner nos sessions start avec les constantes suivante :
            PHP_SESSION_NONE (il n'y a pas de session)
            PHP_SESSION_DISABLED (les sessions sont desactivées)
            PHP_SESSION_ACTIVE (il y a une session démarrée)

        On comparera cela à "session_status()" pour obtenir le status actuel de la session.

        Par défaut, la session prend fin quand le navigateur est fermé, 
        mais si on souhaite le faire perdurer plus longtemps, on peut lui passer une durée de vie en option :
    */
    session_start([
        // Durée de vie en seconde, par défaut 0
        "cookie_lifetime"=> 60
    ]);
    if(session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }

    $title = "Session page 2";
    require "../ressources/template/_header.php";

    /* 
        isset retourne un boolean indiquant si ce qui lui a été fourni en argument existe ou non.
    */
    if(isset($_SESSION["logged"], $_SESSION["panier"], $_SESSION["username"]))
    {
        echo "<p>Bonjour {$_SESSION['username']}</p>";
        echo "Panier : <ul>";
        foreach($_SESSION["panier"] as $product)
        {
            echo "<li>$product</li>";
        }
        echo "</ul>";
    }else
    {
        echo "<p>Veuillez passer par la page 1 d'abbord</p>";
    }
    /* 
        Si on souhaite supprimer une donnée de la session, 
        On pourra le faire comme pour supprimer un élément d'un tableau associatif.
        avec "unset()";
    */
    unset($_SESSION["panier"]);
    /* 
        Si on souhaite supprimer toute la session, 
        On commencera par "session_destroy()";
    */
    session_destroy();
    /* 
        La session est détruite, mais jusqu'au prochain rechargement, 
        la variable "$_SESSION" existe toujours.
        Par sécurité, on va la supprimer aussi
    */
    unset($_SESSION);
    /* 
        La session est supprimé, la superglobal aussi, 
        mais le cookie reste toujours présent,
        pour le supprimer, on lui donnera une durée de vie négative:
    */
    setcookie("PHPSESSID", "", time()-3600);
    /* 
        Un message de warning est créé car nous avons notre header qui est modifié (modification de cookie qui sont envoyé dans les headers)
        alors que du HTML est déjà généré.
        Dans un cas normal, il faudrait faire cela avant l'affichage de tout html.
    */
?>
<hr>
<a href="./07-a-session.php">Page 1</a>
<?php 
    require "../ressources/template/_footer.php";
?>