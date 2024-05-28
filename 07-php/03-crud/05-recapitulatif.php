<?php 
/* 
    Résumons ce que l'on a vu :
        1. Il est important de mettre le fichier contenant les informations de connexion à votre BDD,
            Dans un dossier inaccessible aux utilisateurs.
        2. Au lieu de répéter à chaque fois la connexion à la BDD dans chaque fichier où vous en avez besoin,
            Le faire dans un fichier externe que l'on inclut sera plus pratique.
        3. Si des informations rentrées par l'utilisateur sont requise dans votre requête SQL,
            Il faut faire une requête préparé. Sinon vous pouvez faire une requête simple.
*/
// connexion :
$pdo = new PDO(
    "mysql:host=mysql;port=3306;dbname=biere;charset=utf8mb4", 
    "root", 
    "root", 
    [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, 
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // PDO::ATTR_EMULATE_PREPARES => false
]);
// * requête simple :
$sql = $pdo->query("SELECT * FROM couleur");
echo "<pre>" .print_r($sql->fetchAll(), 1) ."</pre><hr>";
// * requête préparé :
# Avec paramètre anonyme.
$sql = $pdo->prepare("SELECT * FROM couleur WHERE NOM_COULEUR=?");
$sql->execute(["Blanche"]);
echo "<pre>" .print_r($sql->fetch(), 1) ."</pre><hr>";
# Avec paramètre nommé. 
$sql = $pdo->prepare("SELECT * FROM couleur WHERE NOM_COULEUR=:col");
$sql->execute(["col"=>"Brune"]);
echo "<pre>" .print_r($sql->fetch(), 1) ."</pre><hr>";
/* 
    Pour execute, il n'y a que deux types possibles.
        * string ou null.
    Parfois on a besoin de choses un peu plus précises.

    * Par exemple si on laisse activé l'émulation des requêtes préparé de PDO.
    On va avoir un problème si on execute un paramètre avec "LIMIT"
    Ce dernier n'accepte que des chiffres et execute transforme notre chiffre en string.

    Une autre façon de faire est de lier les paramètres est d'utiliser les méthodes :
        * bindValue() et bindParam()
    Elles ont l'avantage de pouvoir accepter plus de type sous la forme de constante :
        - PDO::PARAM_NULL
        - PDO::PARAM_BOOL
        - PDO::PARAM_INT
        - PDO::PARAM_STR
*/
$sql = $pdo->prepare("SELECT * FROM couleur LIMIT :lim");
// provoque une erreur si prepare émulé par PDO
// $sql->execute(["lim"=>2]);
// Toujours valide
$sql->bindValue("lim", 2, PDO::PARAM_INT);
$sql->execute();
echo "<pre>" .print_r($sql->fetchAll(), 1) ."</pre><hr>";

/*
    La principale différence entre bindValue et bindParam se fera au niveau de quand est ce que la valeur sera enregistré :
*/
$couleur = "Blanche";
$sql = $pdo->prepare("SELECT * FROM couleur WHERE NOM_COULEUR=:col");
$sql->bindValue("col", $couleur, PDO::PARAM_STR);
$couleur = "Ambrée";
$sql->execute();
echo "<pre>" .print_r($sql->fetchAll(), 1) ."</pre><hr>";
/*
    Au dessus bindValue est utilisé et il nous répond avec la couleur "Blanche". 
    En dessous bindParam est utilisé et il nous répond avec la couleur "Ambrée". 
    Avec bindValue, on lie la valeur de notre variable.
    Avec bindParam, on lie notre variable, donc si on change la valeur de notre variable avant l'execution. cela changera notre requête.
*/
$couleur = "Blanche";
$sql = $pdo->prepare("SELECT * FROM couleur WHERE NOM_COULEUR=:col");
$sql->bindParam("col", $couleur, PDO::PARAM_STR);
$couleur = "Ambrée";
$sql->execute();
echo "<pre>" .print_r($sql->fetchAll(), 1) ."</pre><hr>";

/*
    Dernier point, on ne peut pas à la fois bind des valeurs
    et donner un tableau à execute.
    C'est soit l'un, soit l'autre.
*/
?>