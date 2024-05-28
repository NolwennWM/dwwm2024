<?php

    session_start();
    require "../../../ressources/service/_pdo.php";
    require "../../../ressources/service/_shouldBeLogged.php";
    require "../../../ressources/service/_csrf.php";


    shouldBeLogged(true, "../connexion.php");

    if(!isset($_SESSION["idUser"], $_GET["id"]) || $_SESSION["idUser"] != $_GET["id"]) {
        header("Location: /");
        exit;
    }
    
    $title = "Blog";
    require "../../../ressources/template/_header.php";
    $error = [];

    $pdo = connexionPDO();
    $sql = $pdo->prepare("SELECT * FROM messages WHERE idUser=?");
    $sql->execute([(int)$_GET["id"]]);
    $messages = $sql->fetchAll();

    $sql = $pdo->prepare("SELECT * FROM category");
    $sql->execute();
    $category = $sql->fetchAll();

    $option = $_POST["category"]??"null";

    if(empty($messages)) {
        $error["message"] = "Vous n'avez envoyé aucun message.";
    } else {

        switch($option) {
            case 'null':
                foreach($messages as $message) {
                    ?>
                    <tr>
                        <td><?=$message["message"]?></td>
                        &nbsp;|&nbsp;
                        <td><?=$category["nom"]??"Aucune catégorie"?></td>
                        &nbsp;|&nbsp;
                        <td><a href="./update.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message["idMessage"]?>">Modifier</a></td>
                        &nbsp;|&nbsp;
                        <td><a href="./delete.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message['idMessage']?>">Supprimer</a></td>
                    </tr>   
                    <br>
                    <?php 
                }
                break;
            case '1':
                foreach($messages as $message) {
                        if($message["idCat"] === 1) {
                        ?>
                        <tr>
                            <td><?=$message["message"]?></td>
                            &nbsp;|&nbsp;
                            <td><?=$category["nom"]??"Aucune catégorie"?></td>
                            &nbsp;|&nbsp;
                            <td><a href="./update.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message["idMessage"]?>">Modifier</a></td>
                            &nbsp;|&nbsp;
                            <td><a href="./delete.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message['idMessage']?>">Supprimer</a></td>
                        </tr>   
                        <br>
                        <?php 
                    }
                }
                break;
            case '2':
                foreach($messages as $message) {
                        if($message["idCat"] === 2) {
                        ?>
                        <tr>
                            <td><?=$message["message"]?></td>
                            &nbsp;|&nbsp;
                            <td><?=$category["nom"]??"Aucune catégorie"?></td>
                            &nbsp;|&nbsp;
                            <td><a href="./update.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message["idMessage"]?>">Modifier</a></td>
                            &nbsp;|&nbsp;
                            <td><a href="./delete.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message['idMessage']?>">Supprimer</a></td>
                        </tr>   
                        <br>
                        <?php 
                    }
                }
                break;
            case '3':
                foreach($messages as $message) {
                        if($message["idCat"] === 3) {
                        ?>
                        <tr>
                            <td><?=$message["message"]?></td>
                            &nbsp;|&nbsp;
                            <td><?=$category["nom"]??"Aucune catégorie"?></td>
                            &nbsp;|&nbsp;
                            <td><a href="./update.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message["idMessage"]?>">Modifier</a></td>
                            &nbsp;|&nbsp;
                            <td><a href="./delete.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message['idMessage']?>">Supprimer</a></td>
                        </tr>   
                        <br>
                        <?php 
                    }
                }
                break;
            case '4':
                foreach($messages as $message) {
                        if($message["idCat"] === 4) {
                        ?>
                        <tr>
                            <td><?=$message["message"]?></td>
                            &nbsp;|&nbsp;
                            <td><?=$category["nom"]??"Aucune catégorie"?></td>
                            &nbsp;|&nbsp;
                            <td><a href="./update.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message["idMessage"]?>">Modifier</a></td>
                            &nbsp;|&nbsp;
                            <td><a href="./delete.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message['idMessage']?>">Supprimer</a></td>
                        </tr>   
                        <br>
                        <?php 
                    }
                }
                break;
        }

        /* if($option === "null") {
            foreach($messages as $message) {
                ?>
                <tr>
                    <td><?=$message["message"]?></td>
                    &nbsp;|&nbsp;
                    <td><?=$category["nom"]??"Aucune catégorie"?></td>
                    &nbsp;|&nbsp;
                    <td><a href="./update.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message["idMessage"]?>">Modifier</a></td>
                    &nbsp;|&nbsp;
                    <td><a href="./delete.php?id=<?=$_SESSION['idUser']?>&amp;idMessage=<?=$message['idMessage']?>">Supprimer</a></td>
                </tr>   
                <br>
                <?php 
            }            
        } */
        

    }

    if(isset($_SESSION["flash"])) {
        $flash = $_SESSION["flash"];
        unset($_SESSION["flash"]);
    }

    if(isset($flash)):
?>

<div class="flash">
    <?=$flash?>
</div>

<?php endif; ?>

<form action="./create.php" method="post">
    <input type="text" name="message">
    <input type="submit" value="Envoyer" name="sendMsg">
    <span class="erreur"><?= $error["message"]??""?></span>
</form>


<form action="" method="post">

    <select name="category">
        <option value="null">Trier par catégorie</option>
        <?php foreach($category as $cat) {
            ?>
            <option value="<?=$cat["idCat"]?>"><?=$cat["nom"]?></option>
            <?php
        }?>
    </select>

    
    <input type="submit" value="Trier" name="trier">
</form>



<?php
    require "../../../ressources/template/_footer.php";
?>