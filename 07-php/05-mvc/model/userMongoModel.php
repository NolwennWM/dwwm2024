<?php 
use MongoDB\Driver\Query;
use MongoDB\Driver\BulkWrite;

require_once __DIR__. "/../../ressources/service/_mongo.php";

$mongo = connexionMongo();
$bulk = new BulkWrite();

/**
 * Récupère tous les utilisateurs
 *
 * @return array
 */
function getAllUsers(): array
{
    $query = new Query([]);
    return queryResult("blog.user", $query, "idUser");
}
/**
 * Selectionne un utilisateur par son email.
 *
 * @param string $email email de l'utilisateur
 * @return array|false
 */
function getOneUserByEmail(string $email):array|false
{
    $query = new Query(["email"=>$email]);
    return queryResult("blog.user", $query, "idUser", true);
}
/**
 * Selectionne un utilisateur via son ID
 *
 * @param string|int $id id de l'utilisateur
 * @return array|false
 */
function getOneUserById(string|int $id):array|false
{
    $query = new Query(["_id"=>getId($id)]);
    return queryResult("blog.user", $query, "idUser", true);
}
/**
 * Ajoute un utilisateur en BDD
 *
 * @param string $username nom de l'utilisateur
 * @param string $email email de l'utilisateur
 * @param string $password mot de passe de l'utilisateur
 * @return void
 */
function addUser(string $username, string $email, string $password): void
{
    global $mongo, $bulk;
    $bulk->insert(["username"=>$username, "email"=>$email, "password"=>$password]);
    $mongo->executeBulkWrite("blog.user", $bulk);
}
/**
 * Supprime un utilisateur via son ID
 *
 * @param string|integer $id id de l'utilisateur
 * @return void
 */
function deleteUserById(string|int $id):void
{
    global $mongo, $bulk;
    $bulk->delete(["_id"=>getId($id)]);
    $mongo->executeBulkWrite("blog.user", $bulk);
}
/**
 * Met à jour un utilisateur via son ID
 *
 * @param string $username Nom de l'utilisateur
 * @param string $email email de l'utilisateur
 * @param string $password mot de passe de l'utilisateur
 * @param string|integer $id id de l'utilisateur
 * @return void
 */
function updateUserById(string $username, string $email, string $password, string|int $id): void
{
    global $mongo, $bulk;
    $bulk->update(["_id"=>getId($id)], ['$set'=>["username"=>$username, "email"=>$email, "password"=>$password]]);
    $mongo->executeBulkWrite("blog.user", $bulk);
}