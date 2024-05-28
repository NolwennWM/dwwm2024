<?php 
header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');

$title = "404";
require(__DIR__."/../../ressources/template/_header.php");
?>
<a href="./">home sweet home</a>
<br>
<a href="./p2">Direction la page 2</a>
<p>Ceci est ma page 404!</p>
<?php 
require(__DIR__."/../../ressources/template/_footer.php");
?>