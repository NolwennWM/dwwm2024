<?php 
require_once __DIR__."/../../ressources/service/_pdo.php";
/**
 * Retourne tous les messages d'un utilisateur.
 *
 * @param integer $idUser
 * @return array|false
 */
function getMessagesByUser(int $idUser): array|false
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT m.*, c.nom as categorie FROM messages m LEFT JOIN category c ON m.idCat = c.idCat WHERE m.idUser = ? ORDER BY m.createdAt DESC");
    $sql->execute([$idUser]);
    return $sql->fetchAll();
}
/**
 * Retourne un message via son id.
 *
 * @param integer $id
 * @return array|false
 */
function getMessageById(int $id): array|false
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM messages WHERE idMessage = ?");
    $sql->execute([$id]);
    return $sql->fetch();
}
/**
 * Retourne les messages d'un utilisateur d'une catégorie donnée.
 *
 * @param integer $idUser
 * @param integer $idCat
 * @return array|false
 */
function getMessagesByUserAndCategorie(int $idUser, int $idCat): array|false
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT m.*, c.nom as categorie FROM messages m LEFT JOIN category c ON m.idCat = c.idCat WHERE m.idUser = ? AND m.idCat = ? ORDER BY m.createdAt DESC");
    $sql->execute([$idUser, $idCat]);
    return $sql->fetchAll();
}
/**
 * Créer un nouveau message en BDD.
 *
 * @param array $values
 *  $values = ["m"=>(string) message, "id"=>(int) idUser, {"cat"=>(int) idCat}]
 * @return void
 */
function addMessage(array $values): void
{
    $pdo = connexionPDO();
    if(count($values) === 2)
    {
        $sql = $pdo->prepare("INSERT INTO messages(message, idUser) VALUES (:m, :id)");
    }
    else
    {
        $sql = $pdo->prepare("INSERT INTO messages(message, idUser, idCat) VALUES (:m, :id, :cat)");
    }
    $sql->execute($values);
}
function deleteMessageById(int $id): void
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("DELETE FROM messages WHERE idMessage=?");
    $sql->execute([$id]);
}
function updateMessageById(int $idMessage, string $content, int $idCat=NULL): void
{
    $pdo = connexionPDO();
    $sql = $pdo->prepare("UPDATE messages SET message=:m, idCat = :cat, editedAt = current_timestamp() WHERE idMessage = :id");
    $sql->execute([
        "m" => $content,
        "cat" => $idCat,
        "id" => $idMessage
    ]);
    
}
?>