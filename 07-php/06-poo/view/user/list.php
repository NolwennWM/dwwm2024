<?php 
// Après avoir créé notre AbstractController.php
$this->getFlash();

if($users):
?>
<table>
    <thead>
        <tr>
            <th>id</th>
            <th>username</th>
            <th>action</th>
        </tr>
    </thead>
    <?php foreach($users as $row):?>
    <tr>
        <td><?php echo $row["idUser"] ?></td>
        <td><?php echo $row["username"] ?></td>
        <td>
            <a href="./messages?id=<?php echo $row["idUser"] ?>">
                Voir
            </a>
            <?php if(isset($_SESSION["idUser"]) && ($_SESSION["idUser"]) == $row["idUser"]): ?>
            &nbsp;|&nbsp;
            <a href="./user/update?id=<?php echo $row["idUser"] ?>">
                Éditer.
            </a>
            &nbsp;|&nbsp;
            <a href="./user/delete?id=<?php echo $row["idUser"] ?>">
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
?>