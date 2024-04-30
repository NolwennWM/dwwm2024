<?php 
#------------------------------------------------------------------------------------
echo "<h1>Déclaration des fonctions.</h1> <hr>";

/*
    Pour déclarer une fonction en PHP, on utilisera le terme "function" suivi d'un nom.
    Un nom de fonction suit les mêmes règles que le nom des variables.
    ensuite on a des parenthèses, puis des accolades qui vont contenir les 
    instructions qui doivent être lancé par la fonction.
*/
function salut(){
    echo "Salut tout le monde ! <br>";
}
salut();
/*
    PHP déclare les fonctions avant de lire le code, donc on peut appeler une fonction
    déclaré plus bas dans le code.
*/
salut1();
function salut1(){
    echo "Salut les autres ! <br>";
}
/*
    Si on déclare une fonction dans une condition,
    on ne pourra l'appeler qu'après sa déclaration
    et attention d'être sûr de l'avoir déclaré si 
    vous tenter de l'appeler hors de la condition.
*/
$isTrue = true;
if($isTrue){
    // retournera une erreur.
    // salut2();
    function salut2(){
        echo "Salut moi même ! <br>";
    }
    salut2();
}
// peut fonctionner tant que la condition est true mais à false provoque une erreur.
// salut2();
// Celui ci sera plus propre et sûr à utiliser :
if($isTrue) salut2();
/*
Une fonction peut se contenter d'effectuer des actions, mais aussi retourner des informations.
Pour cela on utilisera le mot clef "return", ce mot clef mettra fin à la fonction
et retournera la valeur qui suis.
Il est possible d'utiliser un return sans valeur à retourner juste pour mettre fin à une fonction.
*/
function aleaString(){
    $r = rand(0, 100);
    // si $r est plus petit que 50 on ne retourne rien.
    if($r<50)return;
    //sinon on retourne $r transfomé en string.
    return (string)$r;
}
// on peut utiliser la valeur de retour directement dans une autre fonction
echo aleaString(), "<br>";
// ou l'attribuer à une variable.
$alea = aleaString();
echo $alea, "<br>";
#------------------------------------------------------------------------------------
echo "<h1>Arguments</h1> <hr>";
/*
Entre les parenthèses de la déclaration de fonction, nous pouvons avoir 
entre 0 et l'infini arguments. Ces arguments seront séparé d'une virgule.
Quand on appelle une fonction avec un argument, la valeur donnée est transmise
à la variable déclaré dans la fonction.
*/
function bonjour($nom){
    echo "Bonjour $nom ! <br>";
}
// ici $nom devient égale à "Maurice";
bonjour("Maurice");
// Si on ne donne pas exactement le même nombre d'argument, cela retourne une erreur.
// bonjour();
function bonjour1($n1, $n2){
    echo "Bonjour $n1 et $n2 ! <br>";
}
bonjour1("Maurice", "Charli");
// Il est aussi possible d'avoir un nombre d'argument infini :
function bonjour2(...$noms){
    // $noms devient un tableau contenant tous nos arguments.
    foreach($noms as $n){
        echo "Salut $n ! <br>";
    }
}
bonjour2("Maurice", "Charli", "Pierre");

// On peut aussi avoir des valeurs par défaut à nos arguments :
// Dans ce cas, l'argument devient optionnel.
function bonjour3($n1, $n2= "personne d'autre"){
    // les arguments obligatoires doivent être avant les optionnelles.
    echo "Bonjour $n1 et $n2 ! <br>";
}
// Si je donne un seul argument, le second prendra la valeur par défaut
bonjour3("Maurice");
// Si j'en donne deux, alors la valeur par défaut sera oublié.
bonjour3("Maurice", "Charli");
/* quand on donne un argument à une fonction via une variable, 
la variable de base n'est pas changé.
*/
function titre($nom){
    $nom .=" le grand";
    return $nom;
}
$maurice1 = "Maurice";
$maurice2 = titre($maurice1);
// $maurice1 vaut toujours "Maurice";
echo "$maurice1 est devenu $maurice2 ! <br>";
/*
Mais il est aussi possible de passer les arguments par référence.
Cela permet de changer la valeur de la variable donnée en argument.
*/
function titre1(&$nom){
    $nom.=" le grand";
}
titre1($maurice1);
// Ici $maurice1 a bien été modifié.
echo "Voici $maurice1 !";
#------------------------------------------------------------------------------------
echo "<h1>Récurcivité</h1> <hr>";
/* 
    une fonction récurcive est une fonction qui s'appelle elle même. 
    De ce fait il faudra faire attention de bien prévoir une 
    façon de sortir de la récurcivité sinon, nous somme sur une boucle infinie.
*/
function decompte($n){
    // action à réaliser.
    echo $n, "<br>";
    // condition de sortie.
    if($n<=0)return;
    // récurcivité.
    decompte(--$n);
}
decompte(5);
#------------------------------------------------------------------------------------
echo "<h1>Typage et description</h1> <hr>";
/*
    Sur les dernières versions de PHP, il est possible, conseillé bien que non obligatoire
    de typer ses arguments et valeurs de retour ainsi que de décrire ses fonctions.

    Faire ceci ne va pas changer le fonctionnement de votre code mais permettra 
    de s'y retrouver plus facilement si vous y revenez plus tard ou si votre code 
    est repris par quelqu'un d'autre.

    voici un exemple :
*/
/**
 * Cette fonction retourne la présentation du personnage.
 * 
 * Les arguments doivent être le nom de l'utilisateur, l'âge et un boolean
 * indiquant si il travaille ou non.
 *
 * @param string $nom
 * @param integer $age
 * @param boolean $travail
 * @return string
 */
function presentation(string $nom, int $age, bool $travail):string{
    // le type des arguments est passé avant celui ci.
    // entre les () et les {} se trouve le type du return précédé de ":"
    return "Je m'appelle $nom et j'ai $age ans. Je ". ($travail?"travaille":"ne travaille pas");
}
echo presentation("Maurice", 54, true);
#------------------------------------------------------------------------------------
echo "<h1>Portée des variables et static</h1> <hr>";
// Une variable déclaré hors d'une fonction, ne sera pas accessible dans celle ci:
$z = 5;
// $z est hors de toute fonction, on dit qu'elle est global.
function showZ(){
    // $z n'affiche qu'une erreur car différent du $z déclaré globallement.
    // echo $z;
    // le mot clef "global" permet d'utiliser une variable déclaré globalement.
    global $z;
    echo $z;
}
showZ();
echo "<br>";
/*
Normalement une variable dans une fonction est détruite une fois la fonction terminé.
le mot clef "static" permet de la sauvegarder et de ne pas la réinitialiser.
*/
function compte(){
    $a = 0;
    // $b ne sera mis à 0 que lors du premier appel et non les suivants.
    static $b = 0;
    echo "a : $a <br> b : $b <br>";
    $a++;
    $b++;
}
compte();
compte();
compte();

#------------------------------------------------------------------------------------
echo "<h1>fonction anonyme, fléché et callback</h1> <hr>";

/* 
    Bien que rarement utilisé, il est possible d'utiliser des fonctions 
    anonyme et fléché en PHP.
    Une fonction anonyme est une fonction qui ne porte pas de nom.
    elle sera soit rangé dans une variable soit utilisé en callback
    d'une autre fonction (un callback est une fonction donné en 
    argument d'une autre fonction.)

    Une fonction fléché est une version raccourci de la fonction anonyme
*/
$tab = ["Sandwich", "Ramen", "Pizza"];
/**
 * Cette fonction prend un tableau et utilise la fonction donné 
 * en callback pour afficher le contenu du tableau.
 *
 * @param array $arr
 * @param callable $func
 * @return void
 */
function dump(array $arr, callable $func): void{
    // le type callable indique que cet élément peut être appelé.
    foreach($arr as $a){
        // on utilise notre argument comme fonction.
        $func($a);
        echo "<br>";
    }
}
// je donne une fonction anonyme en callback de ma fonction dump;
dump($tab, function($x){ echo $x;});
// Je donne une fonction fléché en callback de ma fonction dump;
dump($tab, fn($x)=>var_dump($x));
// je range ma fonction anonyme dans une variable.
$superFonction = function($x){
    print($x);
    /* attention, cette façon de déclaré une fonction ne peut être 
    appelé avant sa déclaration.*/
};
// je donne ma variable en callback de ma fonction dump;
dump($tab, $superFonction);

?>