<?php 
    $title = "Les dates";
    require "../ressources/template/_header.php";
    // Permet de paramètrer la timezone, le string doit être "continent/capital" en anglais
    date_default_timezone_set("Europe/Paris");
    // Si on souhaite récupérer le timestamp actuel :
    echo time(), "<br>";

    /* 
        Pour obtenir la date actuel, on utilisera la fonction "date()"
        Celle ci peut prendre Un ou deux arguments.
        Le premier est un string sur lequel on reviendra juste après.
        Le second, optionnel, est un timestamp.

        Si on ne lui fourni pas le second, la date utilisé sera celle actuelle
        Si on lui en fourni un, il indiquera la date du timestamp fourni
    */
    echo date("");
    /* 
        Les informations qui vont être retournées par "date()"
        sont dépendante du string qui est fourni.
        Si il est vide, aucune information est retournée.

        Les lettres indiqués dans le string correspondant chacune à une information (majuscule et minuscule sont différente);
    */
    /* 
        d = numéro du jour du mois avec le 0
        m = numéro du mois avec le 0
        Y = Année sur 4 chiffres
    */
    echo date("d/m/Y"), "<br>";

    /* 
        j = numéro du jour du mois sans le 0
        n = numéro du mois sans le 0
        y = Année sur 2 chiffres
    */
    echo date("j/n/y"), "<br>";

    
    /* 
        D = Nom du jour sur 3 lettres
        l = Nom du jour complet
        M = Nom du mois sur 3 lettres
        F = Nom du mois complet
    */
    echo date("D = l / M = F"), "<br>";
    
    /* 
        N = numéro du jour dans la semaine avec dimanche = 7
        w = numéro du jour dans la semaine avec dimanche = 0
    */
    echo date("D = N = w"), "<br>";
    
    /* 
        z = numéro du jour dans l'année avec 1er janvier = 0
        W = Numéro de la semaine dans l'année
    */
    echo date("z -> W"), "<br>";
    
    /* 
        t = nombre de jour dans le mois
        L = boolean indiquant si l'année est bissextile
    */
    echo date("F -> t / Y -> L"), "<br>";
    /* 
        h = l'heure en format 12 avec 0
        i = les minutes avec 0
        s = les secondes avec 0
        a = "am" ou "pm"
    */
    echo date("h:i:s a"), "<br>";
    /* 
        g = l'heure en format 12 sans 0
        A = "AM" ou "PM"
    */
    echo date("g:i:s A"), "<br>";
    /* 
        H = l'heure en format 24 avec 0
        v = millisecondes avec 0
        G = l'heure en format 24 sans 0
        * Les millisecondes ne sont pas géré par défaut par "date()"
    */
    echo date("H:i:s:v / G:i:s"), "<br>";
    /* 
        O = Différences d'heures avec GMT sans ":"
        P = Différences d'heures avec GMT avec ":"
        Z = Différences d'heures avec GMT en seconde
        I = boolean indiquant si c'est l'heure d'été
    */
    echo date("O = P = Z -> I"), "<br>";
    // date complète au format ISO 8601
    echo date("c"), "<br>";

    // date complète au format RFC 2822
    echo date("r"), "<br>";


    require "../ressources/template/_footer.php";
?>