<?php 
require "./routes.php";
require "./classes/Autoloader.php";
require "./classes/Router.php";

Autoloader::register();
Router::routing();
?>