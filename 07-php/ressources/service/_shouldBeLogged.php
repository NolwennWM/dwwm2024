<?php 
if(session_status() === PHP_SESSION_NONE)
    session_start();

/**
 * Vérifie si l'utilisateur est connecté ou non et le redirige dans le cas contraire.
 * 
 * Si le boolean est à true, vérifie si l'utilisateur est connecté.
 * Si le boolean est à false, vérifie si l'utilisateur est déconnecté.
 *
 * @param boolean $logged
 * @param string $redirect
 * @return void
 */
function shouldBeLogged(bool $logged = true, string $redirect = "/"): void
{
    if($logged)
    {
        // Est ce qu'un temps d'expiration est paramètré en session
        if(isset($_SESSION["expire"]))
        {
            // Est ce que le temps est expiré
            if(time() > $_SESSION["expire"])
            {
                unset($_SESSION);
                session_destroy();
                setcookie("PHPSESSID", "", time()-3600);
            }
            else
            {
                // Sinon on renouvelle pour une heure
                $_SESSION["expire"] = time() + 3600;
            }
        } # fin expire
        // Si l'utilisateur n'est pas connecté, on le redirige :
        if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true)
        {
            header("Location: $redirect");
            exit;
        }
    }
    else
    {
        // Si l'utilisateur doit être déconnecté pour accèder à la page :
        if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)
        {
            header("Location: $redirect");
            exit;
        }
    }
}
?>