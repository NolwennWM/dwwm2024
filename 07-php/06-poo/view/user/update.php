<?php
if($user):
?>
<?php require __DIR__."/_form.php"; ?>
<?php else: ?>
    <p>Aucun Utilisateur trouvé</p>
<?php 
endif;
?>