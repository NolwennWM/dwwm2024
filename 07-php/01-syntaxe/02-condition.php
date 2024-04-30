<?php 
$r = rand(0,100);
echo $r, "<br>";

if($r < 50)
{
    echo '$r est plus petit que 50. <br>';
}
// peut s'écrire "elseif" ou "else if"
elseif($r > 50)
{
    echo '$r est plus grand que 50. <br>';
}
else
{
    echo '$r vaut 50. <br>';
}

// On peut encapsuler du HTML dans une condition (ou une boucle php)
if($r > 50)
{
?>
<p>$r est plus grand que 50 !</p>
<?php 
}

echo "<h2>Autre syntaxe possible :</h2> <hr>";
/* 
    On peut oublier les accolades et ajouter ":" après les mots clefs.
    Puis terminer la condition avec "endif;"
*/
if($r < 50):
    echo '$r est plus petit que 50. <br>';
elseif($r > 50):
    echo '$r est plus grand que 50. <br>';
else:
    echo '$r vaut 50. <br>';
endif;

/* 
    Et on retrouve aussi les conditions pour une seule instruction.
*/
if($r < 50)
    echo '$r est plus petit que 50. <br>';
elseif($r > 50)
    echo '$r est plus grand que 50. <br>';
else
    echo '$r vaut 50. <br>';

// Les ternaires sont de retour :
echo '$r est plus '. ($r<=50? "petit ou égale à": "grand que")." 50.<br>";
// Vérifier l'existence d'une variable :
    echo $nonDefinie ?? "La variable précédente n'existe pas";

# -------------------------------------------
echo "<h2>Switch</h2> <hr>";
$pays = ["France", "Japon", "Angleterre", "Suisse", "france"];
// équivalent à : 
// $pays[rand(0, count($pays)-1)]
$r2 = $pays[array_rand($pays)];

echo $r2, "<br>";

switch($r2)
{
    case "Japon":
        echo "Pays réputé pour sa cuisine";
        break;
    case "Suisse":
        echo "Beaucoup trop de langue pour un pays";
        break;
    case "France":
    case "france":
        echo "Autre pays réputé pour sa cuisine";
        break;
    default:
        echo "Je ne connais pas tout les pays";
}

?>