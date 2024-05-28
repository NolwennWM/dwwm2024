<?php 
// Si il n'est pas connecté, redirection
require "../../../../ressources/service/_shouldBeLogged.php";
require "../../../../ressources/service/_csrf.php";
shouldBeLogged(true, "../../connexion.php");

// Si on n'a pas d'id en get, redirection
if(empty($_GET["id"]))goToListe();

require "../../../../ressources/service/_pdo.php";
$pdo = connexionPDO();

$sql = $pdo->prepare("SELECT * FROM messages WHERE idMessage = ?");
$sql->execute([(int)$_GET["id"]]);
$message = $sql->fetch();

// Si on n'a pas de message ou si l'utilisateur n'est pas le propriétaire du message. Redirection.
if(!$message || $message["idUser"] != $_SESSION["idUser"])goToListe();

// Partie 2 uniquement 
$sql = $pdo->query("SELECT * FROM category ORDER BY nom ASC");
$categories = $sql->fetchAll();
// fin Partie 2
$error = $m = "";
if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['editMessage']))
{
    if(empty($_POST["message"]))
    {
        $error = "Veuillez entrer un message";
    }else{
        $m = cleanData($_POST["message"]);
    }
    
    if(empty($error)){
        // Partie 1 uniquement
        // $sql = $pdo->prepare("UPDATE messages SET 
        // message=:m, 
        // editedAt = current_timestamp()
        // WHERE idMessage = :id");
        // Fin partie 1
        // Partie 2 uniquement 
        if(empty($_POST["categorie"])){
            $sql = $pdo->prepare("UPDATE messages SET 
                message=:m, 
                editedAt = current_timestamp(),
                idCat = NULL
                WHERE idMessage = :id");        
        }else{
            $sql = $pdo->prepare("SELECT * FROM category WHERE idCat = ?");
            $sql->execute([(int)$_POST["categorie"]]);
            $cat = $sql->fetch();
            if($cat){
                $sql = $pdo->prepare("UPDATE messages SET 
                message=:m,
                idCat = :cat, 
                editedAt = current_timestamp()
                WHERE idMessage = :id");                
                $sql->bindValue("cat", $cat["idCat"], PDO::PARAM_INT);
            }else{
                $_SESSION["flash"] = "Cette catégorie n'exite pas.";
                goToListe();
            }
        }
        // Fin partie 2.
        $sql->bindValue("m", $m);
        $sql->bindValue("id", $message["idMessage"], PDO::PARAM_INT);
        $sql->execute();
        $_SESSION["flash"] = "Message édité";
        goToListe();
    }
}
function goToListe(){
    header("Location: ./read.php?id=".$_SESSION["idUser"]);
    exit;
}
$title = "édition du message";
require "../../../../ressources/template/_header.php";
?>
<form action="" method="post">
    <textarea name="message" placeholder="Edition du message"
    ><?php echo $message["message"] ?></textarea>
    <span class="error"><?php echo $error??"" ?></span>
    <!-- Partie 2 uniquement -->
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
    <!-- Fin partie 2 -->
    <input type="submit" value="Envoyer" name="editMessage">
</form>
<?php 
require "../../../../ressources/template/_footer.php";
?>