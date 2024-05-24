<?php 
/* 
    PHP à deux principaux outils de connexion à la BDD.
    PDO et MySQLi.
    MySQLi est adapté aux bdd de type MySQL.
    PDO lui est adapté à tout type de BDD SQL.
*/
/**
 * retourne une instance de connexion PDO à la BDD
 *
 * @return \PDO
 */
function connexionPDO(): \PDO
{
    /* 
        grâce au return dans mon fichier config, 
        je peux récupérer le tableau de ce dernier dans une variable.
    */
    $config = require __DIR__ . "/../config/_blogConfig.php";
    /* 
        Nous devons maintenant construire un "DSN", "Data Source Name".
        C'est un string qui contiendra toute les informations pour localiser la BDD.
        Elle prendra la forme suivante :
            pilote:host=adresseHote;port=numeroPort;dbname=nomBDD;charset=charsetChoisi
        par exemple :
            mysql:host=localhost;port=3306;dbName=blog;charset=utf8mb4
    */
    $dsn = 
        "mysql:host=".$config["host"]
        . ";port=".$config["port"]
        . ";dbname=".$config["database"]
        . ";charset=".$config["charset"];

    try
    {
        /* 
            On crée une nouvelle instance de "PDO" en lui donnant en paramètre :
                1. le DSN
                2. le nom d'utilisateur
                3. le mot de passe
                4. les options de PDO

            le "\" dont je fais précéder certaines classes est ici complètement optionnel.
            Il sera utile quand on fera de la POO.
        */
        $pdo = new \PDO(
            $dsn,
            $config["user"],
            $config["password"],
            $config["options"]
        );
        return $pdo;
    }catch(\PDOException $e)
    {
        /* 
            pour les erreurs de type "Exception",
            L'activation de celles ci se fait avec le mot clef "throw"
            On parle de "lancer" une exception.
        */
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
}
?>