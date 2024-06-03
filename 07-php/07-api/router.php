<?php 
$url = filter_var($_SERVER["REQUEST_URI"], FILTER_SANITIZE_URL);
$url = explode ("?", $url)[0];
$url = trim($url, "/");

if(array_key_exists($url, ROUTES))
{
    require "./controller/".ROUTES[$url];
}
else
{
    sendResponse([], 404, "404 Not Found");
}
?>