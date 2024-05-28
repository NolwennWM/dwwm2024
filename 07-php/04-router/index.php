<?php 
// On récupère nos routes.
require "./routes.php";

// J'utilise filter_var pour retirer tout les caractères qui n'ont rien à faire dans un url.
$url = filter_var($_SERVER["REQUEST_URI"], FILTER_SANITIZE_URL);
// echo $url;

// Je supprime les possibles paramètres en GET de l'url
$url = explode("?", $url)[0];
// var_dump($url);

// Je retire de l'url les "/" au début et à la fin de celui ci.
$url = trim($url, "/");
// echo $url;

if(array_key_exists($url, ROUTES))
{
    require "./pages/".ROUTES[$url];
}
else
{
    require "./pages/404.php";
}
?>