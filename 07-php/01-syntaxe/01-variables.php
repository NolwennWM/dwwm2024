<h1>Introduction</h1>
<!-- 
    Le code PHP commence par <?php ?> et ceci le termine 
    Il est commun de voir HTML et PHP dans un même fichier.
-->
<?php 
    // Commentaire sur une seule ligne
    # Autre commentaire sur une seule ligne
    /* 
        Commentaire sur
        Plusieurs lignes
    */
    /* 
        PHP signifie "PHP Hypertext Preprocessor"
        Et ce second PHP est le nom d'origine "Personnal Home Page"

        ! Chaque instruction de PHP se termine par ";"
        Un saut à la ligne ne met pas fin à l'instruction.

        Lorsque l'on veut vérifier la configuration de notre serveur PHP
        On peut utiliser la fonction "phpinfo();"
    */
    // phpinfo();
    /* 
        Par défaut, tout ce qui est écrit en PHP n'est pas visible en HTML.

        Pour afficher quelque chose en HTML il faudra utiliser une des nombreuses fonctions d'écriture de php.

        La plus commune étant "echo" qui n'a d'ailleurs pas besoin de parenthèse.
        Elle peut prendre autant d'argument que voulu.
    */
    echo "machin";
    echo "<h2>", "afficher du texte", "</h2>";
    /* 
        Il existe aussi la fonction "print" qui retournera la valeur "1" et sera un peu plus lente à l'execution.
    */
    print "<br> PHP !!!";
    /* 
        Pour debuguer, on utilisera plus souvent :
    */
    var_dump("Bonjour", "le monde !");
    /* 
        Il existe tout un tas d'autres fonctions d'affichage avec chacune leur particularités.
    */
# ---------------------------------------------
    echo "<h2>Déclaration des variables </h2> <hr>";

    $banane;
    /* 
        On déclare une variable en PHP sans mot clef.
        Elle commencera obligatoirement par un "$" puis une lettre ou un "_", ensuite les chiffres sont acceptés dans son nom.
        Elles sont sensible à la casse (majuscule minuscule)

        PHP n'aime pas les variables "undefined"
    */
    // var_dump($banane);
    $banane = "Jaune";
    echo "banane : ", $banane, "<br>";

    /* 
        Pour définir une constante, deux possibilités :
        L'ancienne :
            define("nomConstante", "valeurConstante");
        la nouvelle :
            const nomConstante = valeurConstante;

        Par convention, les constantes sont souvent écrite en majuscule
    */
    define("AVOCAT", "vert");
    echo "avocat : ", AVOCAT, "<br>";
    const AVOCATS = "verreux";
    echo "avocats : ", AVOCATS, "<br>";

    /* 
        On peut définir le nom d'une variable selon la valeur d'une autre variable.
        On appelle cela une variable dynamique.
    */
    $chaussette = "rouge";
    $$chaussette = "bleu";
    
    echo $rouge, "<br>";
    // On peut détruire une variable avec "unset()";
    unset($banane);
    // On peut voir toute les variables existante avec get_defined_vars():
    var_dump(get_defined_vars());
    // Pour afficher joliement un tableau on peut écrire :
    echo "<pre>" . print_r(get_defined_vars(), 1) . "</pre>";

# --------------------------------------------
    echo "<h2>Types des variables</h2><hr>";

    $num = 5;
    $dec = 0.5;
    $str = "coucou";
    $arr = [];
    $boo = true;
    $nul = null;
    $obj = (object)[];
    
    echo gettype($num), "<br>";// integer
    echo gettype($dec), "<br>";// double (ou float)
    echo gettype($str), "<br>";// string
    echo gettype($arr), "<br>";// array
    echo gettype($boo), "<br>";// boolean
    echo gettype($nul), "<br>";// NULL
    echo gettype($obj), "<br>";// object

# --------------------------------------------
echo "<h1>string</h1> <hr>";
// Un string peut être représenté par "" ou '';
echo "bonjour", 'coucou', "<br>";

// Une instruction php n'étant arrêté que par un ";" on peut très bien faire des sauts à la ligne dans nos strings
echo 
    "<p>
        Ceci est un 
        très long message
    </p>";
/* 
    Pour faire de l'interpolation en PHP,
    Il suffit d'intégrer les variables dans le string 
    Mais cela ne fonctionne qu'avec les guillemets ""
*/
$nom = "Maurice";
$age = 54;
echo "$nom a $age ans. <br>";
echo '$nom a $age ans. <br>';
// Pour faire de la concatenation, on utilisera le ".";
echo $nom . " a " . $age . " ans. <br>";
// équivalent à $nom = $nom . " Dupont";
$nom .= " Dupont";
echo $nom, "<br>";

echo $nom[8], "<br>";
$nom[8] = "L";
echo $nom, "<br>";

# -----------------------------------
echo "<h2>Nombres.</h2> <hr>";

/* 
    Les nombres sont de deux types,
    integer pour un nombre entier.
    double (ou float) pour un nombre à virgule.
*/
var_dump("3.14 is int ?", is_int(3.14));
echo "<br>";
var_dump("3.14 is float ?", is_float(3.14));
/* 
    On peut récupérer le plus gros nombre gérable par php 
    (et le plus petit)
    via des constantes :
*/
echo "<br>";
echo PHP_INT_MAX, "<br>", PHP_INT_MIN, "<br>";
echo PHP_FLOAT_MAX, "<br>", PHP_FLOAT_MIN, "<br>";

// Pour convertire un string ou float en integer, on peut simplement le faire précéder de (int)
echo (int)"42chaussettes", "<br>", (int)3.14, "<br>";

// Evidemment on va retrouver les opérateurs mathématique :
echo "1+1=", 1+1, "<br>";
echo "1-1=", 1-1, "<br>";
echo "2*2=", 2*2, "<br>";
echo "8/2=", 8/2, "<br>";
// modulo (reste de la division)
echo "11%3=", 11%3, "<br>";
// 2 puissance 4
echo "2**4=", 2**4, "<br>";

// On retrouve les opérateurs d'assignement :
$x = 5;
$x += 2;
$x -= 3;
$x *= 4;
$x /= 2;
$x %= 3;
$x **= 2;

echo $x, "<br>";
// On retrouve aussi l'incrémentation et la décrémentation :
echo $x++, "-->", $x, "<br>";
echo ++$x, "-->", $x, "<br>";
echo $x--, "-->", $x, "<br>";
echo --$x, "-->", $x, "<br>";

# ------------------------------------------------------
echo "<h1>Array</h1> <hr>";
/* 
    Il y a deux façon de créer un tableau.
    l'ancienne avec la fonction "array()"
    et la nouvelle directement avec []
*/
$a = array("banane", "pizza", "avocat");
$b = ["banane", "pizza", "avocat"];
// On ne peut pas faire d'echo d'un tableau 
// echo $a;
var_dump($a, $b);
echo '<pre>'.print_r($a, 1).'</pre>';
// Pour selectionner un élément d'un tableau, on indique l'index entre []:
echo "J'aime la $a[0], la $a[1] et l'$a[2]";

// Pour connaître la taille d'un tableau, on utilisera la fonction "count()"
echo count($a), "<br>";

// Pour ajouter un élément à mon tableau :
$b[] = "fraise";

/* 
    En PHP, il existe deux types de tableau.
    Les tableaux classiques indexé par des chiffres.
    Et les tableaux associatif (associative array) dont l'index chiffré est remplacé par une clef nominative (un string)
*/
$person = ["prenom"=>"Maurice", "age"=>54];
// Si je veux afficher les données, j'utilise le nom de mes clefs :
echo $person["prenom"]. " a " .$person["age"]. " ans. <br>";

// Les tableaux peuvent être multidimensionnel :
$person["loisir"] = ["pétanque", "bowling"];
// On accolera les différents crochet pour afficher ces données :
echo $person["loisir"][0], "<br>";

// Supprimer un élément d'un tableau
unset($person["age"]);
echo '<pre>'.print_r($person, 1).'</pre>';

// Cela ne pose aucun problème pour un tableau associatif mais pour un tableau indexé par des nombres :
unset($b[1]);
var_dump($b);
echo "<br>";
// Pour corriger la disparition de l'index 1, deux solutions :
// array_values va créer un nouveau tableau avec les même valeurs :
$b = array_values($b);
var_dump($b);
echo "<br>";
// Soit on supprimera l'élément avec array_splice :
array_splice($a, 1,1);
// Cette fonction supprime un élément du tableau en premier argument, à la position en second argument, sur une longueur donnée en troisième.
var_dump($a);
// On pourra trier un tableau avec sort ou ses dérivés
sort($a);
/* 
    rsort() trier par ordre décroissant :
    pour tableau associatif :
        asort() trier par ordre croissant des valeurs
        ksort() trier par ordre croissant des clefs
        arsort() trier par ordre décroissant des valeurs
        krsort() trier par ordre décroissant des clefs
*/
# --------------------------------------------------
echo "<h2>Boolean</h2> <hr>";
/* 
    Les booleans ne peuvent être que "true" ou "false"
    Ils peuvent être récupéré par les même comparateurs que JS
        <, >, <=, >=, ==, ===, != (ou <>), !== 

    "and" peut s'écrire de deux façons :
*/
var_dump(true and false);
var_dump(true && false);
// De même pour "or"
var_dump(true or false);
var_dump(true || false);

// En php il existe aussi "xor"
var_dump(true xor true);
// vrai uniquement si l'un des deux est vrai. (mais pas les deux)
var_dump(!true);
# --------------------------------------------------------
echo "<h1>Les variables superglobals</h1><hr>";

/* 
    Les variables super globals sont des variables prédéfinies
    accessibles n'importe où dans votre code.

    $GLOBALS
    stock toute les variables globales définies (par vous ou php)

    $_SERVER
    Contient les informations liées au serveur et à la requête

    $_REQUEST
    Contient les mêmes informations que $_POST, $_GET et $_COOKIE

    $_POST
    Contient toute les données envoyé en method POST.

    $_GET
    Contient toute les données envoyé en method GET.

    $_FILES
    Contient toute les informations des fichiers téléversés.

    $_ENV
    Contient les variables d'environnement.

    $_COOKIE
    Contient toute les informations des cookies

    $_SESSION
    Contient toute les informations stockés en session
*/
echo '<pre>'.print_r($_SESSION, 1).'</pre>';
?>