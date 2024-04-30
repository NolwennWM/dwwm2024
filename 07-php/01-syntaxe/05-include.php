<?php
/* 
    Include et require permettent d'inclure d'autres fichiers dans notre code.

    le fichier inclu fera parti du code de la page.
    Donc si une variable est déclaré avant l'inclusion, elle est utilisable dans le code inclu.

    Include et require font parti des quelques fonctions php, dont les parenthèses sont optionnelles.
*/
$title = "Include et Require";
require "../ressources/template/_header.php";
/* 
    La différence entre include et require est :
        en cas d'erreur, include provoquera un "warning" indiquant où se trouve l'erreur puis continuera le reste du code.
        alors que require provoquera une fatal erreur qui mettra fin au code.
*/
?>
<div>
    <!-- p#para$*5>lorem -->
    <p id="para1">
        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero officiis praesentium ipsam magnam, repellendus at hic cumque minima molestias, sit possimus quos quia et distinctio. Magni dolore tempore magnam doloremque.
    </p>
    <p id="para2">
        Modi nesciunt soluta eligendi explicabo repellendus dolore, a exercitationem assumenda mollitia beatae laborum inventore ad porro sunt! Reprehenderit numquam soluta animi cumque possimus incidunt. Amet cupiditate enim numquam ea nihil?
    </p>
    <p id="para3">
        Autem quasi earum maxime saepe voluptatibus odio ea ipsa, veniam totam suscipit dicta itaque excepturi animi. Sunt voluptates est vel quisquam animi dolores, reprehenderit, atque quia earum beatae non fuga?
    </p>
    <p id="para4">
        Reiciendis placeat dolorum voluptatibus quidem praesentium perspiciatis ducimus optio fugiat! Corporis saepe aliquam earum perspiciatis vel, molestiae numquam officia voluptate quidem sit sunt assumenda sapiente neque dignissimos aspernatur. Veniam, neque.
    </p>
    <p id="para5">
        Illum recusandae ipsam, velit rem fugit animi minima tempora tempore cumque nihil eligendi quasi repellat accusamus porro excepturi, alias enim fugiat harum facere? Earum architecto fuga maxime accusantium fugiat velit.
    </p>
</div>

<?php 
/* 
    Les fonctions include et require existent aussi en version "_once"
    "include_once" et "require_once" vont être un peu plus longue à s'executer car 
    Avant d'inclure le fichier, elles vont vérifier qu'il n'a pas déjà été inclu.
*/
include "../ressources/template/_footer.php";
include_once "../ressources/template/_footer.php";
?>