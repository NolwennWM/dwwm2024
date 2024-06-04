<?php 
namespace Model;

use Classes\AbstractModel;

class UserModel extends AbstractModel
{
    /**
     * Récupère la liste de tous les utilisateurs.
     *
     * @return array|false
     */
    function getAllUsers(): array|false
    {
        $sql = $this->pdo->query("SELECT idUser, username FROM users");
        return $sql->fetchAll();
    }
    /**
     * sélectionne un utilisateur par son email
     *
     * @param string $email
     * @return array|false
     */
    function getOneUserByEmail(string $email): array|false
    {
        // $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = ?");
        // $sql->execute([$email]);
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE email = :chaussette");
        $sql->execute(["chaussette"=>$email]);
        return $sql->fetch();
    }
    /**
     * retourne un utilisateur selon son id
     *
     * @param string|integer $id
     * @return array|false
     */
    function getOneUserById(string|int $id): array|false
    {
        $sql = $this->pdo->prepare("SELECT * FROM users WHERE idUser = ?");
        $sql->execute([$id]);
        return $sql->fetch();
    }
    /**
     * ajoute un utilisateur en BDD
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @return void
     */
    function addUser(string $username, string $email, string $password): void
    {
        $sql = $this->pdo->prepare("INSERT INTO users(username, email, password) VALUES(?,?,?)");
        $sql->execute([$username, $email, $password]);
    }
    /**
     * Supprime un utilisateur via son id
     *
     * @param string|integer $id
     * @return void
     */
    function deleteUserById(string|int $id): void
    {
        $sql = $this->pdo->prepare("DELETE FROM users WHERE idUser=?");
        $sql->execute([$id]);
    }
    /**
     * Mis à jour d'un utilisateur via son id
     *
     * @param string $username
     * @param string $email
     * @param string $password
     * @param string|integer $id
     * @return void
     */
    function updateUserById(string $username, string $email, string $password, string|int $id): void
    {
        $sql = $this->pdo->prepare("UPDATE users SET username=:us, email=:em, password = :mdp WHERE idUser=:id");
        $sql->bindParam("us", $username, \PDO::PARAM_STR);
        $sql->bindParam("em", $email, \PDO::PARAM_STR);
        $sql->bindParam("mdp", $password, \PDO::PARAM_STR);
        $sql->bindParam("id", $id, \PDO::PARAM_INT);
        $sql->execute();
    }
}
?>