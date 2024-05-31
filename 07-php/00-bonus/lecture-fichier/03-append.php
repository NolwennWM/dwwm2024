<?php 
/*
    Si on souhaite simplement ajouter quelque chose dans un fichier.
    On utilisera le mode d'ajout, "a" pour "append":
*/
$file = fopen("exemple3.txt", "a");
fwrite($file, "\nCeci est un ajout dans mon fichier.");
fclose($file);

/*
    Si je réactualise ma page, on verra des lignes s'ajouter.

    Nos exemples ont été fait avec des fichiers textes mais vous pouvez le faire avec n'importe quel type de fichier :
*/
fopen("superPage.html", "w");
fopen("script.js", "w");

/*
    Il existe quelques modes d'ouverture différents et des variantes de ceux présenté, mais je vous laisse voir cela par vous même si cela vous intéresse :
        
    https://www.php.net/manual/fr/function.fopen.php

    D'autres fonctionnalités liées aux fichiers sont disponible comme :
    l'existence d'un fichier avec "is_file()"
    le renommage de fichier grâce à "rename()"
*/
if(is_file("superPage.html"))
    rename("superPage.html", "page.html");
/*
    la suppression de fichier avec unlink()
*/
unlink("script.js");
/*
    Vérifier si un dossier existe avec is_dir()
    et la création de dossier avec mkdir()
*/
if(is_dir("poubelle"))
    mkdir("poubelle");
/*
    La suppression de dossier avec rmdir()
*/
rmdir("poubelle");
?>