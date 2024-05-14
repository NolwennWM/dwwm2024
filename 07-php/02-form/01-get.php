<?php
$title = " GET ";
require("../ressources/template/_header.php");
?>
<form action="" method="GET">
    <input type="text" placeholder="Entrez un nom" name="username">
    <!-- les span.error serviront à afficher les messages d'erreur. -->
    <span class="error"><!-- TODO :  --></span>
    <br>
    <fieldset>
        <legend>Nourriture favorite</legend>
        <input type="radio" name="food" id="welsh" value="welsh"> 
        <label for="welsh">Welsh (car vive le fromage)</label>
        <br>
        <input type="radio" name="food" id="cannelloni" value="cannelloni"> 
        <label for="cannelloni">Cannelloni (car les ravioli c'est surfait)</label>
        <br>
        <input type="radio" name="food" id="oyakodon" value="oyakodon"> 
        <label for="oyakodon">Oyakodon (car j'aime l'humour noir)</label>
        <span class="error"><!-- TODO :  --></span>
    </fieldset>
    <label for="boisson">Boisson favorite</label>
    <br>
    <select name="drink" id="boisson">
        <option value="jus de tomate">jus de tomate (je suis un vampire)</option>
        <option value="milkshake">Milkshake (aux fruits de préférence)</option>
        <option value="limonade">Limonade (J'ai besoin de sucre)</option>
    </select>
    <span class="error"><!-- TODO :  --></span>
    <br>

    <input type="submit" value="Envoyer" name="meal">
</form>

<?php 
require("../ressources/template/_footer.php");
?>