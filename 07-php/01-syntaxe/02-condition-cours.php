<?php
$r = rand(0, 100);
echo $r, "<br>";
/*
    rand par défaut donne une valeur aléatoire comprise entre 0 et getrandmax();
    Mais on peut lui donner une valeur minimum et maximum respectivement en premier et second argument.
*/
echo "<h1>Conditions.</h1> <hr>";
if($r < 50){
    // Si la condition est true alors on fait ce qui se trouve entre accolade.
    echo "\$r est plus petit que 50. <br>";
}
elseif($r > 50){
    // On peut optionnellement ajouter un ou plusieurs elseif pour ajouter une nouvelle condition si la précédente est false
    echo "\$r est plus grand que 50. <br>";
}
else{
    // On peut optionnellement ajouter un else qui se déclenchera si toute les conditions précédents sont false.
    echo "\r est égale à 50 <br>";
}
// il est tout à fait possible d'avoir des if dans des if et ainsi de suite.
#------------------------------------------------------------------------------------
echo "<h1>Autres syntaxes.</h1> <hr>";
/* 
Bien que plus rare il est possible d'écrire une condition en remplaçant les accolades
par ":" et de finir notre série de condition par "endif" peu importe que l'on ai mit des else ou elseif.
*/
if($r < 50):
    echo "\$r est plus petit que 50. <br>";
elseif($r > 50):
    echo "\$r est plus grand que 50. <br>";
else:
    echo "\r est égale à 50 <br>";
endif;
/* 
    Il est aussi possible de retirer le ":" et le "endif" mais dans ce cas là 
    seule la première instruction qui suis la condition sera prise en compte.
*/
if($r < 50)
    echo "\$r est plus petit que 50. <br>";
elseif($r > 50)
    echo "\$r est plus grand que 50. <br>";
else
    echo "\r est égale à 50 <br>";
/*
    Il est possible dans les cas où l'instruction est courte de l'écrire sous forme de ternaire 
    une ternaire s'écrit sous la forme :
        condition ? true : false;
*/
echo "\$r est plus ". ($r<=50 ? "petit ou égale à" : "grand que") ." 50.<br>";
// on peut aussi imbriquer des ternaires dans des ternaires si on oublie pas les parenthèses:
echo "\$r est " . ($r<50 ? "plus petit que" : ($r>50? "plus grand que":"égale à")) ." 50.<br>";
// parfois on peut vouloir faire certains actions selon si une variable est défini ou non:
$message1 = "Bonjour le monde <br>";
echo $message1 ?? "rien à dire <br>";
echo $message2 ?? "rien à dire <br>";
// si la variable existe alors on la choisi, sinon on prend la valeur après les "??";
#------------------------------------------------------------------------------------
echo "<h1>switch.</h1> <hr>";
$pays = ["France", "Japon", "Angleterre", "Suisse", "france"];
$r2 = rand(0,count($pays)-1);
echo $pays[$r2], "<br>";
// le switch permet de gérer des cas précis.
switch($pays[$r2]){
    // la valeur donné en argument sera évalué et switch lancera le cas correspondant
    case "Japon":
        echo "Second pays où la cuisine est réputé";
        // chaque cas doit finir par un "break" sinon il enchaînera avec les instructions du cas suivant.
        break;
    case "Suisse":
        echo "Pays où tous ne parlent pas la même langue";
        break;
    case "France":
    case "france":
        // il est possible ainsi d'avoir deux cas faisant la même action.
        echo "Pays de la cuisine !";
        break;
    default:
        // default se lancera si aucun des cas ne correspond.
        echo "Je ne vais pas détailler tous les pays";
}
?>
