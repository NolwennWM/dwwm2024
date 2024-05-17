<?php 
session_start();

function saveList()
{
    $element = $error = "";
    if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["envoyer"]))
    {
        if(empty($_POST["element"]))
        {
            $error = "Vous n'avez pas entré d'élément";
            echo $error;
        }
        else
        {
            $element = $_POST["element"];
            if(!isset($_SESSION["elementList"]))
            {
                $_SESSION["elementList"] = [];
            }
            $_SESSION["elementList"][] = $element;
            var_dump($_SESSION);
            $elementList = $_SESSION["elementList"];
            foreach($elementList as $elem)
            {
                echo "<p>$elem</p>";
            }
        }
    }
}
saveList();
?>
<form action="" method="post">
    <input type="text" name="element" id="list" placeholder="écrire ici">
    <button type="submit" name="envoyer">Envoyer</button>
</form>