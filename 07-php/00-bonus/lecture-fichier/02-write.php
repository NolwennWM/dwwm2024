<?php 

/*
    PHP peut aussi écrire et créer des fichiers.
    pour cela on commencera par ouvrir un fichier.

    On utilisera ce coup ci le mode d'écriture "w" pour "write"
*/
$file = fopen("exemple2.txt", "w");
// Ici mon exemple 2 est le même que mon exemple 1.

/*
    Si je tente d'écrire dans mon fichier avec fwrite() :
*/
fwrite($file, "Bonjour tout le monde !");
/*
    Tout son contenu précédent se voit effacé, le mode d'écriture efface systématiquement le contenu précédent.
*/
fclose($file);
/*
    Pour créer un fichier à partir de zero, il suffit de tenter d'ouvrir en écriture un fichier qui n'existe pas :
*/
$file2 = fopen("exemple3.txt", "w");
/*
    J'ai bien un troisième fichier qui est apparut dans lequel je peux écrire ce que je souhaite :
*/
fwrite($file2, "Mon nouveau fichier !");
fclose($file2);
/*
    à noter qu'il existe la fonction file_put_contents()
    qui revient à appeler les fonctions fopen(), fwrite() et fclose() successivement. 
*/
file_put_contents("exemple3.txt", "Finalement pourquoi se compliquer la vie ?");
?>