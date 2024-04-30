<?php 
echo "<h2>While</h2> <hr>";

$x = 0;

while($x < 5)
{
    $x++;
    ?>
    <p>Ceci est l'élément numéro <?= $x;?></p>
    <?php
    // "<?=" équivaut à "<?php echo"
}
// syntaxe ":" et "endwhile;"
while($x < 10):
    echo $x++, "<br>";
endwhile;
// syntaxe pour une seule instruction :
while($x < 15)
    echo $x++, "<br>";

# -----------------------------------
echo "<h2>do while</h2><hr>";
// do while lance ses instructions une première fois avant de vérifier si il doit se répéter
do{
    echo $x, "<br>";
    $x++;
}while($x <5);
// syntaxe avec une seule instruction :
do
echo $x++, "<br>";
while($x < 5);
# ----------------------------------------
echo "<h2>for</h2><hr>";
for($y = 0; $y < 5; $y++)
{
    echo $y, "<br>";
}
// syntaxe en ":" et "...end";
for($y = 0; $y < 5; $y++):
    echo $y, "<br>";
endfor;
// syntaxe en une seule instruction :
for($y = 0; $y < 5; $y++)
    echo $y, "<br>";

# ---------------------------------------------------
echo "<h2>foreach</h2><hr>";
$a = ["spaghetti", "thon", "mayonnaise", "oignon"];

// foreach crée une boucle pour chaque élément du tableau.
foreach($a as $food)
{
    echo $food, "<br>";
}
// On peut récupérer l'index du tableau avec :
foreach($a as $key => $food)
{
    echo $key, " : ", $food, "<br>";
}
// syntaxe avec "end"
foreach($a as $food):
    echo $food, "<br>";
endforeach;
// syntaxe pour une seule instruction :
foreach($a as $food)
    echo $food, "<br>";

# ------------------------------------------
echo "<h2>Continue et break</h2><hr>";
// Cet exemple est sur foreach mais ils sont utilisable sur toute les boucles.
foreach($a as $food)
{
    // continue met fin à l'itération actuelle et passe à la suivante
    if($food === "spaghetti") continue;
    // break met fin à la boucle.
    if($food === "mayonnaise") break;

    echo $food, "<br>";
}
?>