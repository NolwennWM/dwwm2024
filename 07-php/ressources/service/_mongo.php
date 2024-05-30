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
{}
/**
 * Transforme l'id en ObjectId
 *
 * @param string|integer $id
 * @return ObjectId
 */
function getId(string|int $id): ObjectId
{}
?>