<?php 
/*
    PHP a la capacité de lire et écrire les fichiers qui se trouvent sur le serveur.

    On va voir ici les quelques fonctions qui permettent cela.

    La fonction fopen() permet d'ouvrir le fichier en premier argument.
    le second argument indique quel mode est utilisé. 
    Voyons ensemble le mode "r" pour "read",
    Cela ouvre le fichier en lecture seule.
*/

$file = fopen("exemple1.txt", "r");
/*
    fgetc va retourner un caractère du fichier puis déplacer le curseur au caractère suivant.
*/
echo fgetc($file);
// Si je l'appelle plusieurs fois, il lira les caractères un à un.
for($i=0; $i<10; $i++)
{
    echo fgetc($file);
}
echo "<hr>";
/*
    Si jamais on souhaite déplacer le curseur sans avoir à lire les caractères, on peut utiliser :

    fseek()
*/
fseek($file, 0);
/*
    On peut aussi lire notre fichier ligne par ligne.

    Pour cela on utilisera fgets()
*/
echo fgets($file);
echo "<br>";
/* 
    Pareillement le curseur est déplacé à chaque itération.
    Si on dépasse le nombre de ligne, il n'affichera rien de plus.
*/
for($i=0; $i<10; $i++)
{
    echo fgets($file), "<br>";
}
echo "<hr>";
fseek($file, 0);

/*
    On peut aussi indiquer combien d'octet doivent être lu;
    pour cela on utilisera :
    fread()
*/
echo fread($file, 20);
echo "<br>";
/*
    Une façon de lire un fichier en entier est d'indiquer à 
    fread() la taille du fichier grâce à filesize();
*/
echo fread($file, filesize("exemple1.txt"));
// On remarquera qu'il continue depuis là où le curseur s'est arrêté

echo "<hr>";
fseek($file, 0);
/*
    Une autre façon de lire un fichier en entier est de détecter que le curseur se trouve à la fin du fichier grâce à feof() (file end of file)
*/
while(!feof($file))
{
    // On peut utiliser n'importe laquelle des fonctions de lecture.
    echo fgetc($file);
}

/*
    Quand on a fini d'utiliser un fichier il est important de le fermer. 
    Un serveur n'est qu'un simple ordinateur, si vous ouvrez des tas de fichier sans jamais les fermer, 
    votre serveur va finir par ralentir sous le poid de tout ce qui est ouvert.

    on utilisera alors la fonction fclose();
*/
fclose($file);
echo "<hr>";
/*
    Notons aussi l'existence d'une fonction  file_get_contents() qui a pour effet de lire le fichier en entier sans avoir besoin d'ouvrir ou fermer celui ci.
*/
echo file_get_contents("exemple1.txt");
?>