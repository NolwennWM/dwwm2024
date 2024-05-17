<?php 
session_name("JUSTEPRIX");
session_start();
$try = null;
$response = [
    "message"=>"Veuillez choisir un nombre entre 1 et 100, vous avez 7 essais",
    "type"=>"start" 
];
if(!isset($_SESSION["target"])) start();
if($_SERVER["REQUEST_METHOD"] == "GET"){
    if(isset($_GET["play"]) && isset($_GET["try"])){
        if(is_numeric($_GET["try"])){
            $try = (int)$_GET["try"];
            $response = checkTry($try);
        }else{
            $response = [
                "message"=>"J'ai demandé un nombre !",
                "type"=>"error"
            ];
        }
    }
    elseif(isset($_GET["restart"])) start();
    else $response["message"] = "Partie Terminée"; 
}
function start(){
    $_SESSION["target"] = rand(0,100);
    $_SESSION["turn"] = 7;
}
function checkTry($t){
    $s = $_SESSION["target"];
    if($t <0 || $t>100)
        return [
            "message"=>"J'ai dit entre 0 et 100!",
            "type"=>"error"
        ];
    $_SESSION["turn"]--; 
    if($t == $s)
        return [
            "message"=>"C'est gagné !",
            "type"=>"success"
        ];
    if($_SESSION["turn"] <= 0){
        return [
            "message"=>"Vous avez perdu !",
            "type"=>"fail"
        ];
    }
    if($t > $s)
        return [
            "message"=>"C'est plus petit !",
            "type"=>"info"
        ];
    if($t < $s)
        return [
            "message"=>"C'est plus grand !",
            "type"=>"info"
        ];
}
$reveal = $response["type"]=="success" 
        || $response["type"]=="fail"
        || $_SESSION["turn"] <= 0;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Plus ou Moins</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="plusOuMoins">
        <div class="card-wrapper">
            <div class="card <?php echo $reveal?"reveal":""; ?>">
                <div class="front">
                    <span><?php 
                    echo $reveal? $_SESSION["target"] :"?";
                    ?></span>
                    <form action="" method="GET">
                        <input type="submit" value="Recommencer" name="restart">
                    </form>
                </div>
                <div class="back"></div>
            </div>
        </div>
        <p class="message <?php echo $response["type"] ?>">
            <?php echo $response["message"] ?>
        </p>
        <div class="gameZone">
            <form action="" method="GET">
                <input type="number" autofocus max="100" min="0" name="try" <?php echo $reveal?"disabled":"" ?>>
                <input type="submit" value="Proposer" name="play" <?php echo $reveal?"disabled":"" ?>>
            </form>
        </div>
    </div>
</body>

</html>