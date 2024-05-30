<?php
require("./routes.php");

$url = filter_var($_SERVER["REQUEST_URI"], FILTER_SANITIZE_URL);
$url = explode("?",$url)[0];
$url = trim($url, "/");

if(array_key_exists($url, ROUTES)){ 
    // J'inclu le controlleur qui correspond à l'url.
    require("./controller/".ROUTES[$url]["controller"]);
    // J'appelle la fonction qui correspond à l'url.
    ROUTES[$url]["fonction"]();
}else{
    require("view/404.php");
}
?>