<?php
/* 
    Cette fois ci nos routes sont plus complexe. 
    Elles sont liées à un controller et à une fonction.
*/
const ROUTES = [
    "05-mvc"=>[
        "controller"=>"userController.php", 
        "fonction"=>"readUsers"
    ],
    "05-mvc/inscription"=>[
        "controller"=>"userController.php", 
        "fonction"=>"createUser"
    ],
    "05-mvc/user/update"=>[
        "controller"=>"userController.php", 
        "fonction"=>"updateUser"
    ],
    "05-mvc/user/delete"=>[
        "controller"=>"userController.php", 
        "fonction"=>"deleteUser"
    ],
    // exercice:
    "05-mvc/connexion"=>[
        "controller"=>"authFormateurController.php", 
        "fonction"=>"login"
    ],
    "05-mvc/deconnexion"=>[
        "controller"=>"authFormateurController.php", 
        "fonction"=>"logout"
    ],
    "05-mvc/message/list"=>[
        "controller"=>"messageFormateurController.php", 
        "fonction"=>"readMessage"
    ],
    "05-mvc/message/create"=>[
        "controller"=>"messageFormateurController.php", 
        "fonction"=>"createMessage"
    ],
    "05-mvc/message/update"=>[
        "controller"=>"messageFormateurController.php", 
        "fonction"=>"updateMessage"
    ],
    "05-mvc/message/delete"=>[
        "controller"=>"messageFormateurController.php", 
        "fonction"=>"deleteMessage"
    ]
];
?>