<?php 
    /* 
        Lorsque l'on souhaite utiliser la session,
        Il faut toujours commencer par la démarrer avec :
            session_start();
        !Attention : On ne doit commencer une session, qu'avant tout affichage HTML
    */
    session_start();

    $title = "Session page 1";
    require "../ressources/template/_header.php";
    /* 
        Lorsque l'on lance cette fonction, 
        Si aucune session n'existe, elle en crée une, sinon elle récupère celle existante.

        Lorsqu'une session est créé, elle possède un id pour la différencié des autres.
        Et celui ci est partagé au navigateur de l'utilisateur via un cookie nommé par défaut "PHPSESSID"

        On pourra récupérer l'id de session via "session_id()";
    */
    var_dump(session_id());
    /* 
        Pour sauvegarder ou récupérer des informations en session.
        On peut tout simplement utiliser la superglobal "$_SESSION".

        Celle ci est un tableau associatif pouvant contenir tout type de données.
    */
    $_SESSION["username"] = "Maurice";
    $_SESSION["panier"] = ["boule de pétanque", "quille de bowling"];
    $_SESSION["logged"] = true;
?>
<hr>
<a href="./07-b-session.php">Page 2</a>
<?php 
    require "../ressources/template/_footer.php";
?>