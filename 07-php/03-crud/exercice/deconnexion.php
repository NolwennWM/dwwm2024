<?php 
session_start();

require "../../ressources/service/_shouldBeLogged.php";
shouldBeLogged();

unset($_SESSION);
session_destroy();
setcookie("PHPSESSID", "", time()-3600);

header("Location: ./connexion.php");
exit;
?>