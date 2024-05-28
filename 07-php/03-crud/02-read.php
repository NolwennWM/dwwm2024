<?php 
session_start();
require "../ressources/service/_pdo.php";

$pdo = connexionPDO();
/* 
    Ma requête ne contient aucune données rentrée par l'utilisateur
    Je n'ai donc pas besoin de requête préparée.
    J'utiliserais donc la methode "query" qui est executé directement.
*/
$sql = $pdo->query("SELECT idUser, username FROM users");
/* 
    Lorsque ma requête attend plusieurs résultats.
    J'utiliserais "fetchAll()" au lieu de "fetch()"
*/
$users = $sql->fetchAll();


/* 
    Gestion de message flash envoyé depuis un autre fichier:
*/
if(isset($_SESSION["flash"]))
{
    $flash = $_SESSION["flash"];
    unset($_SESSION["flash"]);
}
$title = " CRUD - Read ";
require("../ressources/template/_header.php");
// affichage message flash
if(isset($flash)):
?>
<div class="flash">
    <?= $flash ?>
</div>
<?php endif;?>
<h3>Liste des utilisateurs</h3>

<?php if($users): ?>
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>action</th>
        </tr>
    </thead>
    <!-- Pour chacun des utilisateurs trouvé, on ajoute une ligne -->
    <?php foreach($users as $row):?>
    <tr>
        <td><?php echo $row["idUser"] ?></td>
        <td><?php echo $row["username"] ?></td>
        <td>
            <a href="exercice/blog/read.php?id=<?php echo $row["idUser"] ?>">
                Voir
            </a>
            &nbsp;|&nbsp;
            <a href="exercice/blog/formateur/read.php?id=<?php echo $row["idUser"] ?>">
                Voir (correction formateur)
            </a>
            <!-- On affiche le bouton éditer que si l'utilisateur est connecté -->
            <?php if(isset($_SESSION["idUser"]) && ($_SESSION["idUser"]) == $row["idUser"]): ?>
            &nbsp;|&nbsp;
            <a href="03-update.php?id=<?php echo $row["idUser"] ?>">
                Éditer.
            </a>
            &nbsp;|&nbsp;
            
            <a href="04-delete.php?id=<?php echo $row["idUser"] ?>">
                Supprimer.
            </a>
            <?php endif; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<!-- Sinon on affiche un message -->
<?php else: ?>
    <p>Aucun utilisateur trouvé</p>
<?php 
endif;
require("../ressources/template/_footer.php");
?>