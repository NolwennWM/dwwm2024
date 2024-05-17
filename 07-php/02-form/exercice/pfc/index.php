<?php 
session_name("PFCSESSION");
session_start();
$plS = $aiS = "";
$signs = ["p", "f", "c"];
$message = "Choisi !";
if(!isset($_SESSION["score"])) start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["sign"]) && in_array($_POST["sign"], $signs)){
        $message = checkWin();
        header("refresh:2");
    }
}
function start(){
    $_SESSION["score"] = ["ai"=>0, "pl"=>0];
    $_SESSION["signs"] = ["p"=>1, "f"=>1, "c"=>1, "t"=>3];
}
function checkWin(){
    global $plS, $aiS;
    $plS = $_POST["sign"];
    $aiS = selectAI();
    $_SESSION["signs"][$plS]++;
    $_SESSION["signs"]["t"]++;
    if($plS === $aiS){
        return "Égalité !";
    }
    else if(($aiS==="c" && $plS==="p")||($aiS==="p" && $plS==="f")||($aiS==="f" && $plS==="c")){
        $_SESSION["score"]["pl"]++;
        return "Gagné !";
    }
    else{
        $_SESSION["score"]["ai"]++;
        return "Perdu !";
    }   
}
function selectAI(){
    $r = rand(0,100);
    $tp = $_SESSION["signs"]["p"]/$_SESSION["signs"]["t"]*100;
    $tf = $_SESSION["signs"]["f"]/$_SESSION["signs"]["t"]*100;
    return $r < $tp ? "f" : ($r < ($tf+$tp) ? "c":"p");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pierre Feuille Ciseau</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="interface">
        <div class="score">
            <?php echo "IA : ". $_SESSION["score"]["ai"]
            . " | Vous : ". $_SESSION["score"]["pl"] ?>
        </div>
        <div class="message"><?php echo $message ?></div>
    </div>
    <div class="zoneIA">
        <div class="card-wrapper">
            <div class="card <?php echo $aiS == "p" ? "reveal":""?>">
                <div class="front">
                    <img src="../../../ressources/images/jeux/pierre.svg" alt="Pierre">
                </div>
                <div class="back"></div>
            </div>
        </div>
        <div class="card-wrapper">
            <div class="card <?php echo $aiS == "f" ? "reveal":""?>">
                <div class="front">
                    <img src="../../../ressources/images/jeux/feuille.svg" alt="Feuille">
                </div>
                <div class="back"></div>
            </div>
        </div>
        <div class="card-wrapper">
            <div class="card <?php echo $aiS == "c" ? "reveal":""?>">
                <div class="front">
                    <img src="../../../ressources/images/jeux/ciseaux.svg" alt="Ciseaux">
                </div>
                <div class="back"></div>
            </div>
        </div>
    </div>
    <div class="zonePlayer">
        <div class="card-wrapper">
            <div class="card <?php echo $plS == "p" ? "reveal":""?>">
                <div class="front">
                    <img src="../../../ressources/images/jeux/pierre.svg" alt="Pierre">
                </div>
                <div class="back">
                    <form action="" method="POST">
                        <input type="hidden" name="sign" value="p">
                        <input type="image" src="../../../ressources/images/jeux/pierre.svg" alt="Pierre">
                    </form>
                </div>
            </div>
        </div>
        <div class="card-wrapper">
            <div class="card <?php echo $plS == "f" ? "reveal":""?>">
                <div class="front">
                    <img src="../../../ressources/images/jeux/feuille.svg" alt="Feuille">
                </div>
                <div class="back">
                    <form action="" method="POST">
                        <input type="hidden" name="sign" value="f">
                        <input type="image" src="../../../ressources/images/jeux/feuille.svg" alt="Feuille">
                    </form>
                </div>
            </div>
        </div>
        <div class="card-wrapper">
            <div class="card <?php echo $plS == "c" ? "reveal":""?>">
                <div class="front">
                    <img src="../../../ressources/images/jeux/ciseaux.svg" alt="Ciseaux">
                </div>
                <div class="back">
                    <form action="" method="POST">
                        <input type="hidden" name="sign" value="c">
                        <input type="image" src="../../../ressources/images/jeux/ciseaux.svg" alt="Ciseaux">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>