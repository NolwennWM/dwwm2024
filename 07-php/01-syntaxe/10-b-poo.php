<?php 
/*
    Un des avantages de la POO c'est de pouvoir ne plus ce soucier d'avoir 2 fonctions ou 2 variables ayant le même nom dans notre projet. 
    Puisque ces fonctions et variables font partie d'objet, elles peuvent avoir le même nom tant qu'elles sont dans une classe différente.

    $maSuperClass->travail(); est différent de $petiteClass->travail();

    Mais sur un très gros projet avec énormément de bibliothèques différentes, il est possible d'avoir deux classes ayant le même nom.
    Et on se retrouve alors avec le même problème que l'on avait avec les noms de fonction.
    Impossible de déclarer deux classes ayant le même nom.

    C'est là qu'entre jeux les namespaces.
*/
#---------------------------NAMESPACE et USE------------------------
/*
    les namespaces sont un peu comme des dossiers virtuels. 
    On ne crée pas vraiment de dossier mais on range nos classes dans un chemin que l'on nomme comme on le souhaite.
    
    le namespace se déclare toujours tout en haut d'un fichier, avant tout autre code. 
    On utilise le mot clef "namespace" suivi d'un chemin que l'on choisi séparé par des "\". 
*/
require "./10-a-poo.php";
// class enfant extends Humain{}
// $hum = new Humain();
/*
    Si je tente de faire hériter Humain vers enfant, PHP va me dire qu'il ne connaît pas de classe "Humain", pourtant elle existe bien 
    dans le fichier que l'on a requis, pourquoi cette erreur? 

    De même si je tente de créer un nouvel humain.

    Simplement car si vous vous souvenez, tous en haut du précédent fichier, j'ai utilisé un namespace. "namespace Cours\POO;"
    Donc toute les classes que j'ai déclaré dans le précédent fichier, sont d'office rangé dans ce namespace.

    Pour pouvoir utiliser une classe utilisant ce namespace j'ai plusieurs solutions.

    Soit écrire le chemin complet du namespace complété du nom de la classe concerné :
*/
class enfant1 extends Cours\POO\Humain{}
$hum1 = new Cours\POO\Humain();
# Soit utiliser le mot clef "use" suivi du chemin du namespace et de la classe.
use Cours\POO\Humain;

class enfant2 extends Humain{}
$hum2 = new Humain();

#2.1. si on se retrouve avec deux classes du même nom, on a la possibilité de leur donner un alias avec le mot clef "as":
use Cours\POO\Humain as H;

class enfant3 extends H{}
$hum3 = new H();
# La troisième possibilité dans le prochain fichier.
?>