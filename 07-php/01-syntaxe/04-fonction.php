<?php 

function titre($nom)
{
    $nom .= " le grand";
    return $nom;
}
$prenom = "Maurice";
$prenom2 = titre($prenom);

echo "$prenom est devenu $prenom2 ! <br>";

// Passer un argument par référence :
function titre2(&$nom)
{
    $nom .= " le grand";
}
$prenom3 = "Pierre";
titre2($prenom3);
echo "Voici $prenom3 ! <br>";

# ----------------------------------------
echo "<h2>Typage et description</h2><hr>";
/**
 * retourne la présentation d'une personne
 *
 * @param string $nom nom de l'utilisateur
 * @param integer $age age de l'utilisateur
 * @param boolean $travail indique si il travaille ou non
 * @return string
 */
function presentation(string $nom, int $age, bool $travail): string
{
    return "Je m'appelle $nom et j'ai $age ans. Je ". ($travail?"travaille": "ne travaille pas"). " ! <br>";
}
echo presentation("Maurice", 54, false);
#------------------------------------------
echo "<h2>portée des variables et static</h2><hr>";

$z = 5;
function showZ()
{
    // La fonction n'a accès qu'aux variables qui lui sont fourni en paramètre.
    // echo $z;
    // le mot clef "global" permet d'aller chercher une variable sur le scope global. (hors de la fonction)
    global $z;
    echo $z, "<br>";
}
showZ();

function compte()
{
    $a = 0;
    // static permet de garder en mémoire la variable à chaque fois que la fonction est appelé.
    static $b = 0;
    echo "a : $a <br> b: $b <br>";

    $a++;
    $b++;
}
compte();
compte();
compte();
compte();
?>