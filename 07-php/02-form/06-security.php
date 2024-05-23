<?php 
session_start();
$title = "Sécurité";
require "../ressources/template/_header.php";
/* 
    Nous parlerons ici des 4 principales failles de sécurité auxquels faire attention en développement web.
        - XSS
        - CSRF
        - Injection SQL
        - Brute Force

    Le XSS ou "Cross Site Scripting" est le fait pour un utilisateur malveillant, de pouvoir intégrer des balises HTML ou du code JS directement dans votre page.
    Toute entrée de l'utilisateur doit être filtré soit avant la mise en bdd, soit au moment de l'affichage.
    Deux fonctions sont principalement utilisé pour cela :
        - htmlspecialchars()
        ou
        - htmlentities()
*/
$messageUtilisateur = "<script>alert('vous avez été hacké')</script>";
// echo $messageUtilisateur, "<br>";
echo htmlspecialchars($messageUtilisateur), "<br>";
echo htmlentities($messageUtilisateur), "<br>";

/* 
    CSRF ou "Cross Site Request Forgery"
    Le principe est de créer un formulaire qui semble anodin, 
    mais qui va en fait rediriger vers la page de traitement de formulaire d'un autre site (souvent un site où vous avez un compte, voir des droits spécifiques)
    et valider via des input de type hidden une requête que vous n'avez pas validé. 

    La solution classique pour s'en protéger est l'utilisation de token.
    Lorsqu'on arrive sur la page du formulaire, on génère un token (une suite de caractère) aléatoire que l'on sauvegarde en session.
    On placera un input de type hidden dans notre formulaire avec en value, ce même token.
    Et lorsque l'on traitera les données du formulaire, on vérifiera que le token correspond à la value envoyé.
    Si cela vient d'un autre formulaire, on n'aura pas de correspondance.
*/
function setCSRF(int $time = 0): void
{
    // Optionnellement on peut donner un temps limite pour valider le formulaire
    if($time > 0)
    {
        $_SESSION["tokenExpire"] = time()+ 60*$time;
    }
    $_SESSION["token"] = bin2hex(random_bytes(50));
    echo '<input type="hidden" name="token" value="'.$_SESSION["token"].'">';
}
function isCSRFValid():bool
{
    // Si le jeton n'a pas de temps d'expiration, ou si il est toujours valide
    if(!isset($_SESSION["tokenExpire"]) || $_SESSION["tokenExpire"]>time())
    {
        // Si le jeton existe en session et en post, et qu'ils sont égaux
        if(isset($_SESSION["token"], $_POST["token"]) && $_SESSION["token"] === $_POST["token"])
        {
            return true;
        }
    }
    http_response_code(405);
    return false;
}
/* 
    L'injection SQL,
    le principe est de taper une requête SQL dans n'importe quel champ d'un formulaire.
    Et que celle ci soit executé.

    Pour éviter cela, toute requête faite à la BDD qui inclu des données utilisateurs, doit être "une requête préparé"

    Nous allons voir plus tard qu'il y a deux façon d'envoyer une requête à la BDD.
    La première avec la méthode "query()" où l'on se contentera de taper la requête sous forme de string. (aucune sécurité)
    La seconde avec la méthode "prepare()" où l'on remplacera toute les données utilisateur dans le string par "?" ou ":unMot" 

    Dans ce second cas, la requête est lu séparément des données.
    Et les données sont envoyés par la suite.

    Plus de détail dans le cours suivant où l'on se connectera à la bdd.
*/
$username = "Maurice";
$password = "Pizza";
// Non sécurisé :
"INSERT INTO users(username, password) VALUES($username, $password)";
// Sécurisé :
"INSERT INTO users(username, password) VALUES(?, ?)";
// Les données sont fourni après.

/* 
    Le brute force 
    Il consiste en l'envoi de millier de requête à un formulaire de connexion, afin d'essayer toute les combinaisons possible de mot de passe.

    Pour celui ci il existe des tas de réponse possible.
    - bloquer un compte après X echec pendant une durée limité ou jusqu'à validation d'un email.
    - limiter le nombre de requête à 1 par seconde (ou plus lent) afin de ralentir les bots
    - La double authentification, en plus du mot de passe, demander à l'utilisateur de rentrer un code envoyé par "email", "sms", "application".
    - Valider un CAPTCHA ! 

*/
$error = $pass = $hash = "";

if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['password']))
{
    if(empty($_POST["password"]))
    {
        $error = "Veuillez entrer un mot de passe";
    }
    else
    {
        $pass = trim($_POST["password"]);
        /* 
            password_hash permet de hacher un mot de passe afin de le rendre illisible.
            Il est important de toujours hacher les mots de passe sauvegardé en BDD.

            Le premier paramètre est le mot de passe à hacher,
            le second une constante au choix entre :
                - PASSWORD_DEFAULT
                - PASSWORD_BCRYPT
                - PASSWORD_ARGON2I
                - PASSWORD_ARGON2ID
        */
        $hash = password_hash($pass, PASSWORD_DEFAULT);

        /* 
            Ce formulaire n'est pas très pro et affiche le mot de passe en clair sur la page.
            Donc il faut le protéger des attaques XSS
        */
        $pass = htmlspecialchars($pass);
    }
    // Vérification CSRF
    if(!isCSRFValid())
    {
        $error = "La méthode utilisée n'est pas permise";
    }
    // vérification captcha :
    if(empty($_POST["g-recaptcha-response"]))
    {
        $error = "Captcha non fourni";
    }
    else
    {
        $url = "https://www.google.com/recaptcha/api/siteverify";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $data = [
            "secret"=>"6LfPA-YpAAAAAP6RXySRH7lVnpNpihsBRzCSvTdf",
            "response"=>$_POST["g-recaptcha-response"]
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $resp = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($resp, true);

        if(!$response["success"])
        {
            $error = "Captcha Invalide";
        }
    }
    // Fin vérification Captcha
}
?>
<h2>Hacher un mot de passe :</h2>
<form action="" method="POST">
    <input type="text" name="password" placeholder="Mot de passe à hacher" required>
    <!-- CSRF : -->
    <?php setCSRF(); ?>
    <!-- fin CSRF -->
    <input 
        type="submit" 
        value="Hacher" 
        class="g-recaptcha" 
        data-sitekey="6LfPA-YpAAAAAB-dij3zUjzyJVT7wiqVXVJQJG3x" 
        data-callback='onSubmit' 
        data-action='submit'>
    <span class="error"><?php echo $error??"" ?></span>
</form>
<?php if(empty($error) && !empty($pass)):?>
    <p>
        Votre mot de passe "<?= $pass ?>" a été haché en "<?= $hash ?>"
    </p>
<?php 
    endif;
    require "../ressources/template/_footer.php";
    /* 
        En exercice vous avez dû intégrer un captcha.
        Si vous êtes passé par celui de google cela se fait en plusieurs étapes :
        1. La création de deux clef, une publique et une secrète sur le site de google recaptcha.
        2. L'ajout de script dans votre page HTML
        3. L'ajout d'attribut sur le boutton de soumission de votre formulaire dont votre clef public (en tout cas pour la v3)
        4. la récupération d'un token envoyé en post lors de la soumission de votre formulaire
        5. l'envoi d'une requête en POST à l'api google recaptcha avec en paramètre le token et votre clef secrète
        6. la traduction des données json récupérés
        7. la vérification que les données json indique une réussite du captcha.
    */
?>