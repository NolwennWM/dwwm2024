<?php 
if(session_status() === PHP_SESSION_NONE)
session_start();
/**
 * Paramètre un token en session et ajoute un input:hidden contenant le token.
 * 
 * Optionnellement ajoute un temps de vie au jeton.
 *
 * @param integer $time
 * @return void
 */
function setCSRF(int $time = 0): void
{
    // si $time est plus grand que 0 on ajoute en session un temps avant expiration
    if($time>0)
    $_SESSION["tokenExpire"] = time() + 60*$time; 
    /* 
        random_bytes va retourner un nombre d'octet aléatoire d'une longueur donnée en paramètre.
        bin2hex va transformer ces octets en hexadecimal.
        On range le tout en session.
    */
    $_SESSION["token"] = bin2hex(random_bytes(50));
    // On affiche un input hidden contenant notre jeton.
    echo '<input type="hidden" name="token" value="'.$_SESSION["token"].'">';
}
/**
 * Vérifie si le jeton est toujours valide.
 *
 * @return boolean
 */
function isCSRFValid(): bool
{
    // Si le jeton n'a pas de date d'expiration ou si il est toujours valide.
    if(!isset($_SESSION["tokenExpire"]) || $_SESSION["tokenExpire"] > time()){
        // Si le jeton existe et est bien le même que celui donné par le formulaire.
        if( isset($_SESSION['token'],$_POST['token']) && $_SESSION['token'] == $_POST['token'])
        return true;
    }
    // Sinon on indique un code 405 et retourne false.
    if(isset($_SERVER['SERVER_PROTOCOL']))
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
    return false;
}
/* 
    Profitons d'avoir un fichier qui va être importé 
    dans tous nos formulaire pour y placer notre 
    fonction de nettoyage des entrés utilisateur
    que l'on va réutiliser à chaque page.
*/
/**
 * Sanitize a string
 *
 * @param string $data
 * @return string
 */
function cleanData(string $data): string{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}
?>