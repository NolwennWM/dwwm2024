<?php 
    $title = "Go To";
    require "../ressources/template/_header.php";

    /* 
        Le go to permet de sauter une partie du code
        On peut s'en servir dans une condition, ou une boucle à la façon d'un break.
        ! Attention, on ne peut pas :
            entrer dans une fonction, une boucle, une condition avec goto.
            sortir d'une fonction.

        go to fonctionne en deux parties, la première est une balise qui servira d'ancre à notre goto.
            Elle est représenté par "unMotChoisi:"
            Et le mot clef "goto" suivi du nom d'un ancre.
    */
    for ($i=1; $i <= 10; $i++) 
    { 
        echo "<p>Ceci est le message $i !</p>";
        if($i === 5)
        {
            // le goto indique ici que l'on sort de la boucle et saute un echo
            goto fin;
        }
    }
    echo "<p>Ce message est voué à disparaître</p>";
    // Ici une balise pour goto que j'ai nommé "fin"
    fin:
    echo "<p>Ceci est la fin du code !</p>";

    require "../ressources/template/_footer.php";
?>

