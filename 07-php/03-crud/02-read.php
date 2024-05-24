<?php 
$users = "";
$title = " CRUD - Read ";
require("../ressources/template/_header.php");
?>
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