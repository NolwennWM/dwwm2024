<?php 
use MongoDB\BSON\ObjectId;
use MongoDB\Driver\Query;
use MongoDB\Driver\Manager;
/**
 * Retourne un manager de connexion à une BDD mongo
 *
 * @return Manager
 */
function connexionMongo(): Manager
{
    $config = require __DIR__."/../config/_mongoConfig.php";
    /* 
        Le dsn de mongo prend la forme suivante :
            driver://username:password@host:port
    */
    $dsn = "mongodb://{$config['user']}:{$config['password']}@{$config['host']}:{$config['port']}";

    try
    {
        $mongo = new Manager($dsn);
        return $mongo;
    }catch(Exception $e)
    {
        echo "Exception reçue : {$e->getMessage()}";
    }
}
/**
 * Recupère le résultat d'une requête.
 *
 * @param string $collection nom de la collection (table)
 * @param Query $query  query à executer
 * @param string $idName nom de l'id dans la collection
 * @param boolean $one true si on veut un seul résultat
 * @return array
 */
function queryResult(string $collection, Query $query, string $idName, bool $one = false): array
{
    global $mongo;
    // execute dans la collection en premier argument, la requête en second argument.
    $cursor = $mongo->executeQuery($collection, $query);
    // Défini sous quelle forme les résultats doivent être affiché.
    $cursor->setTypeMap(["root"=>"array"]);
    // Je récupère le résultat sous forme de tableau :
    $result = $cursor->toArray();
    // Change l'objet id en string :
    $betterResult = setId($result, $idName);
    // Si $one vaut true et que j'ai au moins un résultat, je retourne le premier résultat uniquement
    if($one && count($result)) return $betterResult[0];
    // Sinon je retourne tout.
    return $betterResult;
}
/**
 * Traduit l'id en string utilisable 
 * (par défaut les id de mongoDB sont des objets)
 *
 * @param array $result résultat de la requête
 * @param string $idName nom de l'id
 * @return array
 */
function setID(array $result, string $idName): array
{
    for($i = 0; $i < count($result); $i++)
    {
        $result[$i][$idName] = (string)$result[$i]["_id"];
    }
    return $result;
}
/**
 * Transforme l'id en ObjectId
 *
 * @param string|integer $id
 * @return ObjectId
 */
function getId(string|int $id): ObjectId
{
    return new ObjectId((string)$id);
}
?>