<?php 
namespace COURS\POO;
/*
    La troisième possibilité est de travailler dans le même namespace.
    Ici j'ai précisé à nouveau le namespace en haut, et il trouve directement mes classes.
*/
require "./10-a-poo.php";

class enfant extends Humain{}
$hum = new Humain();

/*
    Attention quand vous travaillez avec un namespace,
    les classes de base de PHP (PDO, Exception...) ne seront pas reconnu :
*/
// $ex = new Exception();
/*
    Pour pouvoir les utiliser à nouveau, il faudra les faire précéder de "\" pour leur indiquer 
    de rechercher dans le namespace "racine" et non dans celui en cours.
*/
$ex = new \Exception();

/* 
    Dernier point sur la POO:

    Certes les namespace sont virtuel et ne correspondent pas à de vrai dossiers.
    Mais c'est une bonne pratique de les faire correspondre à de vrai dossiers.
    Et cela pourrait être utile si vous utilisez un autoloader (Une fonction qui permet de faire les 
    require de nos classes automatiquement quand on les instancies.)

    De plus ici on a fait plein de classes dans un même fichier, mais la bonne pratique est de faire:
        - Une classe par fichier.
        - Le fichier porte le même nom que la classe.
        - les deux commencent par une majuscule.
        - Si un namespace est utilisé, les dossiers correspondent.
*/
?>