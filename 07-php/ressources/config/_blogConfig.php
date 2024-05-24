<?php 
/* 
    On crée un fichier de configuration,
    Afin de regrouper et retrouver facilement les informations succeptible de changer.

    Ici on utilise php mais selon le projet, un fichier de configuration peut être un ".env", un fichier "yaml" ou autre.

    Pour des raisons de sécurité, c'est une bonne chose que le fichier de configuration ne soit pas accessible via une url.
*/
return [
    "host"=>$_ENV["DB_HOST"],
    "port"=>"3306",
    "database"=>$_ENV["DB_NAME"],
    "user"=>$_ENV["DB_USER"],
    "password"=>$_ENV["DB_PASSWORD"],
    "charset"=>"utf8mb4",
    // options de PDO
    "options"=>[
        // Mode d'affichage des erreurs
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        // façon de retourner les données (ici tableau associatif)
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        // désactivation de l'émulation des requêtes préparés 
        PDO::ATTR_EMULATE_PREPARES => false
    ]
];
?>