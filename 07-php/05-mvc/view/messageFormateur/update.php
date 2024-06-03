<?php
$title = "édition du message";
require(__DIR__."/../../../ressources/template/_header.php");
?>
<form action="" method="post">
    <textarea name="message" placeholder="Edition du message"
    ><?php echo $message["message"] ?></textarea>
    <span class="error"><?php echo $error??"" ?></span>
    <select name="categorie">
        <option value="">Selection de catégorie</option>
        <?php foreach($categories as $cat): ?>
            <option 
                value="<?php echo $cat["idCat"] ?>"
                <?php echo ($cat["idCat"]==$message["idCat"])?"selected":"" ?>
            >
                <?php echo $cat["nom"] ?>
            </option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Envoyer" name="editMessage">
</form>
<?php 
require(__DIR__."/../../../ressources/template/_footer.php");
?>