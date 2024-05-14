<?php 
session_start();
?>
<!-- 
    ----------------------------Exercice D1-----------------------------
    écrire une fonction "frenchDate" qui retournera la date du jour 
    en français, puis l'afficher (exemple : jeudi 25 août 2022);
-->
<!-- 
    ----------------------------Exercice D2-----------------------------
    Utiliser la fonction précédement créé pour afficher la date 
    puis l'heure depuis laquelle l'utilisateur visite le site.
    On utilisera les sessions.
-->

<!-- 
    ----------------------------Exercice D3-----------------------------
    Afficher depuis combien de seconde l'utilisateur est présent sur le site.
-->

<?php 
function frenchDate()
{
    $jour_fr = array(
        'Sunday' => 'Dimanche',
        'Monday' => 'Lundi',
        'Tuesday' => 'Mardi',
        'Wednesday'=> 'Mercredi',
        'Thursday' => 'Jeudi',
        'Friday' => 'Vendredi',
        'Saturday' => 'Samedi'
    );
    $mois_fr = array (
        'January' => 'Janvier',
        'February' => 'Fevrier',
        'March' => 'Mars',
        'April'=> 'Avril',
        'May'=> 'Mai',
        'June'=> 'Juin',
        'July'=> 'Juillet',
        'August'=> 'Aout',
        'September'=> 'Septembre',
        'October' => 'Octobre',
        'November'=> 'Novembre',
        'December'=> 'Decembre',
    );
    $jourfr = $jour_fr[date("l")];
    $moisfr = $mois_fr[date("F")];
    $datefr = $jourfr.  date(" d "). $moisfr. date(" Y");
    if(isset($_SESSION["timestamp"]))
    {
        $tempsécoulé = time() - $_SESSION["timestamp"];
        echo "Vous êtes connecté depuis $tempsécoulé secondes. <br>";
        echo "Vous êtes connecté depuis le {$_SESSION['date']}. <br>";
    }
    else
    {
        $_SESSION["timestamp"] = time();
        $_SESSION['date'] = $datefr . date(" h:i:s");
        echo "C'est votre première visite sur le site. <br>";
    }
    echo "Nous somme le $datefr <br>";
}
frenchDate();
?>