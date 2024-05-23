<?php 
if(session_status() === PHP_SESSION_NONE)
session_start();
    // Liste des caractères accepté pour le captcha
    $characters = 'ABCDEFGHJKLMNPQRSTUVWXYZ0123456789';
    /**
     * Génère une chaîne de caractère aléatoire.
     *
     * @param string $characters
     * @param integer $strength
     * @return string
     */
    function generateString(string $characters, int $strength = 10): string {
        $randStr = '';
        // on boucle un nombre de fois équivalent à notre argument $strength.
        for($i = 0; $i < $strength; $i++) 
        {
            // On choisi un caractère aléatoire dans notre liste de caractère disponible.
            $randStr .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randStr;
    }
    // Génère une nouvelle image avec (largeur, hauteur). qui est un objet de classe GdImage
    $image = imagecreatetruecolor(200, 50);
    // active les fonctions d'antialias, cela améliorera la qualité de l'image.
    imageantialias($image, true);
    
    $colors = [];
    // On choisi une plage de couleur aléatoirement.
    $red = rand(125, 175);
    $green = rand(125, 175);
    $blue = rand(125, 175);
    
    for($i = 0; $i < 5; $i++) {
      /* 
        imagecolorallocate prend un objet GdImage en premier argument.
        Puis 3 valeurs numérique représentant les niveau de couleur rgb
        Retourne un INT qui représente un identifiant pour la couleur généré. 
      */
      $colors[] = imagecolorallocate($image, $red - 20*$i, $green - 20*$i, $blue - 20*$i);
    }
    /* 
      Rempli un objet GdImage donné en premier argument 
      à partir des positions donné en second et troisième argument.
      avec l'identifiant de couleur donné en quatrième argument.
    */
    imagefill($image, 0, 0, $colors[0]);
    
    for($i = 0; $i < 10; $i++) 
    {
      // paramètre une largeur pour une ligne en pixel.
      imagesetthickness($image, rand(2, 10));
      /* 
        dessine un rectangle pour l'objet GdImage donné en premier argument.
        avec la position de départ x, y donné en second et troisième arguments.
        la position de fin donnée en quatrième et cinquième argument.
        et la couleur donné en sixième argument.
      */
      imagerectangle($image, rand(-10, 190), rand(-10, 10), rand(-10, 190), rand(40, 60), $colors[rand(1, 4)]);
    }
    /* On prépare les couleurs possible pour le texte, ici noir et blanc. */
    $textColors = [imagecolorallocate($image, 0, 0, 0), imagecolorallocate($image, 255, 255, 255)];
    /* On prépare un tableau des différentes polices d'écriture possible. */
    $fonts = [__DIR__.'/../fonts/Acme-Regular.ttf', __DIR__.'/../fonts/arial.ttf', __DIR__."/../fonts/typewriter.ttf"];
    
    // On choisi une taille pour notre captcha et on génère notre texte aléatoire.
    $strLength = 6;
    $captchaStr = generateString($characters, $strLength);
    // On sauvegarde en session notre texte aléatoire.
    $_SESSION['captchaStr'] = $captchaStr;
    /* 
      Plutôt que d'afficher notre texte d'un coup, on va afficher les caractères un à un avec 
      des valeurs différentes. couleur, angle... 
    */
    for($i = 0; $i < $strLength; $i++) {
      // On choisi un espacement entre les lettres et une position de départ initial en px.
      $letterSpace = 170/$strLength;
      $initial = 15;
      /* 
        imagettftext permet d'écrire du texte dans notre image en utilisant une police au format ttf.
        En premier argument on donne l'image dans laquelle écrire. un objet GdImage.
        En second une taille pour le texte.
        En troisième un angle en degrés.
        En quatrième et cinquième des positions x et y.
        En sixième une couleur.
        En septième une police d'écriture.
        En huitième le texte à écrire.
      */
      imagettftext(
        $image, 
        24, 
        rand(-15, 15), 
        (int)($initial + $i*$letterSpace), 
        rand(25, 45), 
        $textColors[rand(0, 1)], 
        $fonts[array_rand($fonts)], 
        $captchaStr[$i]
      );
    }
    /* 
      ici on indique en entête de notre fichier que le type de son contenu est une image au format png.
    */
    header('Content-type: image/png');
    /* 
      Puis on transforme notre objet GdImage en image au format png.
    */
    imagepng($image);
?>