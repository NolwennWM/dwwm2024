<?php
/* 
    On va voir comment téléverser un fichier (upload)
    Même si nous ne ferons pas ici l'enregistrement en BDD.

    Il est important de retenir que dans le cas d'un envoi de fichier,
    Tout ce qui est enregistré en BDD, c'est le nom voir le chemin vers le fichier.

    Le fichier en lui même est juste enregistré sur notre serveur.
*/
$error = $target_file = $target_name = $mime_type = $oldName = "";
// chemin vers le dossier où seront enregistré mes fichiers :
$target_dir = "./upload/";
// liste des types mime acceptés :
$typePermis = ["image/png", "image/jpeg", "image/gif", "application/pdf"];

if($_SERVER["REQUEST_METHOD"]=== "POST" && isset($_POST["upload"]))
{
    /* 
        Lorsque l'on upload un fichier, le serveur va le sauvegarder dans un dossier temporaire.
        Une fois le script effectué, le contenu du dossier temporaire est effacé.

        Notre rôle va être de vérifier si le fichier est valide, et si c'est le cas, le déplacer dans un dossier choisi.

        La première étape va être de vérifier si l'upload s'est bien passé.
        Le serveur a des paramètres bloquant les fichiers trop lourd, 
        il peut avoir un problème de connexion,
        on va donc vérifier que le fichier est bien arrivé. 

        is_uploaded_file indique si le chemin donner en paramètre est bien un fichier téléversé. 
        Les informations des fichiers se trouvent dans la superglobal $_FILES
        à laquelle on donnera la clef qui correspond au name de l'input type file.
        On trouvera alors un autre tableau associatif qui aura entre autre chose, le nom temporaire de notre fichier :
    */
    if(!is_uploaded_file($_FILES["fichier"]["tmp_name"]))
    {
        $error = "Veuillez selectionner un fichier";
    }
    else
    {
        /* 
            On trouvera le nom du fichier à la clef "name"
            Et on utilisera basename pour se débarasser d'éventuel "/nomDossier/" qui pourraient poser problème.  
        */
        $oldName = basename($_FILES["fichier"]["name"]);
        /* 
            Si un second fichier est upload avec le même nom qu'un précédent, 
            il le remplacera.

            Pour éviter cela, on va renommer le fichier,
            Une façon classique est d'utiliser "uniqid()" 
            Celui ci produira 13 caractères se voulant unique.

            Optionnellement on peut lui ajouter un premier paramètre pour ajouter un prefixe
            Et un secon paramètre qui est un boolean qui fera passer le nombre de caractères à 23.
        */
        $target_name = uniqid(time()."-", true)."-".$oldName;
        // Je concatène le chemin vers le dossier d'upload et le nom du fichier.
        $target_file = $target_dir . $target_name;
        // Je récupère le type mime du fichier :
        $mime_type = mime_content_type($_FILES["fichier"]["tmp_name"]);
        // On vérifie si le fichier existe déjà :
        if(file_exists($target_file))
        {
            $error = "Ce fichier existe déjà";
        }
        /* 
            Ensuite il est bon d'interdire les upload bien trop lourd
            Attention, le poid du fichier est donné en octet
            5 000 000 octet = 5mo
        */
        if($_FILES["fichier"]["size"]>5000000)
        {
            $error = "Ce fichier est trop lourd";
        }
        // Je vérifie que le type mime du fichier est dans ma liste de type accepté
        if(!in_array($mime_type, $typePermis))
        {
            $error = "Ce type de fichier n'est pas accepté";
        }
        // si on a pas d'erreur :
        if(empty($error))
        {
            /* 
                move_uploaded_file va déplacer le fichier depuis sa zone temporaire
                jusqu'au dossier d'upload prévu à cet effet.
                elle retournera un boolean indiquant si le déplacement s'est bien passé.
            */
            if(move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file))
            {
                /* 
                    On pourrait alors ici enregistrer le nom du fichier en bdd.
                */
            }
            else
            {
                $error = "Erreur lors de l'upload";
            }
        }
    }
}


require("../ressources/template/_header.php");
?>
<!-- Notre formulaire est assez classique, on oublie juste pas l'attribut :
    "enctype" lorsque l'on veut uploader un fichier. -->
<form action="" method="post" enctype="multipart/form-data">
    <label for="fichier">Choisir un fichier :</label>
    <input type="file" name="fichier" id="fichier">
    <input type="submit" value="Envoyer" name="upload">
    <span class="error"><?php echo $error??""; ?></span>   
</form>
<!-- On affiche cette partie que is on a envoyé notre formulaire et qu'il n'y a aucune erreur. -->
<?php if(isset($_POST["upload"]) && empty($error)): ?>
    <p>
        Votre fichier a bien été téléversé sous le nom "<?= $target_name ?>". <br>
        Vous pouvez le télécharger <br>
        <a href="<?= $target_file ?>" download="<?= $oldName ?>">ICI</a>
    </p>
<?php
endif;
require("../ressources/template/_footer.php");
?>