<?php 
#------------------------------------------------------------------------------------
echo "<h1>While.</h1> <hr>";
// Les boucles permettent de répéter une action un certain nombres de fois.
$x = 0;
// Tant que la condition est true, l'action entre accolade sera répété.
while($x < 5){
    echo $x , "<br>";
    // Attention à bien avoir une condition de sortie de la boucle.
    $x++;
    // ici $x va augmenter jusqu'à ce que la condition devienne fausse.
    //! sans condition de sortie, on se retrouve avec une boucle infini.
}
// syntaxe en ":" endwhile;
while($x<10): 
    echo $x++ , "<br>";
endwhile;
// syntaxe qui ne prend que l'instruction suivante.
while($x<15)
echo $x++ , "<br>";
#------------------------------------------------------------------------------------
echo "<h1>Do While.</h1> <hr>";
/* do while va au moins faire l'action une fois, puis après vérifier 
si il doit répéter l'action ou non.*/
do{
    echo $x , "<br>";
    $x++;
    // Ici la condition est fausse mais le message s'affichera une première fois.
}while($x <5);
// syntaxe ne prenant qu'une seule instruction.
do
echo $x++ , "<br>";
while($x<20);
// il n'y a pas de structure ":" - "end" pour le do while.
#------------------------------------------------------------------------------------
echo "<h1>For.</h1> <hr>";
/* la boucle for est particulièrement adapté aux boucles basé sur un chiffre.
    elle est structuré ainsi :
    for(expr1, expr2, expr3){ instruction à répéter }
    expr1 sera évalué avant de commencer la boucle, quoi qu'il arrive.
    expr2 sera évalué au début de chaque itération et continuera la boucle si "true"
    expr3 sera évalué à la fin de chaque itération.
    Dans l'exemple ci dessous, 
    expr1 : on défini $y à 0 avant de commencer la boucle;
    expr2 : avant chaque itération on vérifie si $y < 5;
    expr3 : après chaque itération on incrémente $y. */
for($y = 0; $y <5; $y++){
    echo $y , "<br>";
}
// structure en ":" - "end";
for($y = 0; $y <10; $y++):
    echo $y , "<br>";
endfor;
// structure avec une seule instruction.
for($y = 0; $y <15; $y++)
    echo $y , "<br>";
#------------------------------------------------------------------------------------
echo "<h1>Foreach.</h1> <hr>";
$a = ["spaghetti", "thon", "mayonnaise", "oignon"];
// foreach permet d'itérer sur un tableau.
foreach($a as $food){
    // foreach va faire un nombre d'itération équivalente au nombre d'élément dans le tableau.
    // à chaque itération, un nouvel élément sera assigné à la variable donné dans le foreach.
    echo $food, "<br>";
}
/* Cette structure permet de récupéré la clef en même temps que la valeur.
Si ce n'est pas forcément très utile avec un tableau indexé numériquement,
ça peut être bien plus intéressant sur un tableau associatif. */
foreach($a as $key => $food){
    echo $key, " : ", $food, "<br>";
}
// structure en ":" - "end";
foreach($a as $food):
    echo $food, "<br>";
endforeach;
// structure avec une seule instruction.
foreach($a as $food)
    echo $food, "<br>";
#------------------------------------------------------------------------------------
echo "<h1>Continue et break</h1> <hr>";
foreach($a as $food){
    // continue met fin à l'itération actuelle et passe à la suivante.
    if($food === "spaghetti") continue;
    // break met fin à la boucle.
    if($food === "mayonnaise") break;
    echo $food, "<br>";
}
// Cet exemple est en foreach mais ils peuvent être utilisé dans la plupart des boucles.
?>