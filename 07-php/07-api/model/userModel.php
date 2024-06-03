<?php 
require_once __DIR__. "/../../ressources/service/_pdo.php";
/**
 * Récupère tous les utilisateurs
 *
 * @return array
 */
function getAllUsers(): array
{
    $pdo = connexionPDO();
    $sql = $pdo->query("SELECT idUser, username FROM users");
    return $sql->fetchAll();
}
/**
 * Selectionne un utilisateur par son email.
 *
 * @param string $email email de l'utilisateur
 * @return array|false
 */
function getOneUserByEmail(string $email):array|false
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $sql->execute([$email]);
    return $sql->fetch();
}
/**
 * Selectionne un utilisateur via son ID
 *
 * @param string|int $id id de l'utilisateur
 * @return array|false
 */
function getOneUserById(string|int $id):array|false
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM users WHERE idUser=?");
    $sql->execute([$id]);
    return $sql->fetch();
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
    $pdo = connexionPDO();
    $sql = $pdo->prepare("INSERT INTO users(username, email, password) VALUES(?,?,?)");
    $sql->execute([$username, $email, $password]);
}
/**
 * Supprime un utilisateur via son ID
 *
 * @param string|integer $id id de l'utilisateur
 * @return void
 */
function deleteUserById(string|int $id):void
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("DELETE FROM users WHERE idUser=?");
    $sql->execute([$id]);
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
    $pdo = connexionPDO();
    $sql = $pdo->prepare("UPDATE users SET username=?, email=?, password=? WHERE idUser = ?");
    $sql->execute([$username, $email, $password, $id]);
}