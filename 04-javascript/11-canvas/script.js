"use strict";
/* 
    La balise canvas ne sert à rien sans JS.
    Mais avec JS on pourra créer des dessins ou animations complexes
    mais qui restent légère pour le navigateur. 
*/
const canvas = document.querySelector('canvas');
// ? ----------- Optionnelle, redimensionner le canvas ------
function resize()
{
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
resize();
window.addEventListener("resize", resize);
// ? -------------- Interagire avec le Canvas --------------
/* 
    Pour intéragire avec le canvas, 
    on va devoir récupérer le "context".
    Cela va définir si on travail en 2D, en 3D avec webgl.
    Pour cela on utilisera la méthode "getContext"
*/
const ctx = canvas.getContext("2d");
/* 
    fillRect et strokeRect permettent de dessiner des rectangles, 
    respectivement, plein et vide.
    Ils prennent les paramètres suivant :
        position X, position Y, largeur, hauteur
    Les valeurs sont des nombres qui représentent des pixels.
*/
ctx.fillRect(50, 50, 150, 25);
ctx.strokeRect(100, 150, 25, 150);
/* 
    fillStyle et StrokeStyle sont des propriétés qui permettent de changer la couleur de remplissage et de contour.
    Elles prennent un string (rgb, hexadecimal, mot clef)

    Le changement s'applique uniquement sur les dessins suivants.
*/
ctx.fillStyle = "rgba(156, 78, 94, 0.5)";
ctx.strokeStyle = "red";
ctx.fillRect(25, 59, 78, 95);
ctx.strokeRect(150, 150, 54, 245);

/* 
    Pour des formes plus complexes, 
    on devra les dessiners ligne par ligne.

    On commencera par indiquer au context que l'on veut commencer un nouveau chemin:
*/
ctx.beginPath();
// Puis on déplacera notre curseur(crayon) là où on souhaite commencer le dessin :
ctx.moveTo(345, 70);
// Puis on indique jusqu'où on souhaite tracer le trait :
ctx.lineTo(450, 200);
// Pour afficher notre forme, on devra lui indiquer de la dessiner :
ctx.stroke();

ctx.beginPath();
ctx.moveTo(400, 300);
ctx.lineTo(500, 40);
ctx.lineTo(160, 543);
// closePath va tenter de créer une ligne pour refermer notre forme.
ctx.closePath();
ctx.strokeStyle = "green";
ctx.fillStyle = "yellow";
// lineWidth permet de gérer l'épaisseur du trait
ctx.lineWidth = 8;
ctx.stroke();
// fill permet de remplir la forme dessiné.
ctx.fill();

// ? ------------- Cercle ------------
ctx.beginPath();
/* 
    arc permet de dessiner des cercles ou arc de cercle avec les propriétés suivantes :
    position X, position Y, taille du rayon,
    position de départ du radiant (0 pour un cercle complet)
    position de fin du radiant (Math.PI*2 pour un cercle complet)
*/
ctx.arc(89, 90, 42, 0, 2*Math.PI);
ctx.stroke();
// Supprime ce qui se trouve dans le rectangle défini en paramètre:
ctx.clearRect(50, 60, 70, 80);
// Pour tout supprimer :
// ctx.clearRect(0, 0, canvas.width, canvas.height);

// ? --------------- Animation ------------------
/* 
    "getImageData" permet de récupérer un objet contenant les données des pixels dans le rectangle donné en argument.

    Inversement "putImageData" permet en prenant l'objet créé par "getImageData" de redessiné ce qui a été sauvegardé.
*/
let snapshot = ctx.getImageData(0,0, canvas.width, canvas.height);

let x = 100, y = 100, vitesseV = 5, vitesseH = 5, r = 80;

function moveCercle()
{
    ctx.clearRect(0,0, canvas.width, canvas.height);
    ctx.putImageData(snapshot, 0,0);
    ctx.lineWidth = 8;
    ctx.beginPath();
    ctx.arc(x, y, r, 0, Math.PI*2);
    ctx.fill();
    ctx.stroke();

    if(x+r > canvas.width || x-r < 0)
    {
        vitesseH = -vitesseH;
    }
    if(y+r > canvas.height || y-r < 0)
    {
        vitesseV = -vitesseV;
    }
    x += vitesseH;
    y += vitesseV;
    /* 
        Rappel la fonction callback un nombre de fois par seconde équivalente au raffraichissement de l'écran.
        Et se met en pause quand l'onglet n'est pas actif
    */
    requestAnimationFrame(moveCercle);
}
moveCercle();

// ? ----------------- Images -----------------------
// Je crée un nouvel objet Image
let img = new Image();
// Je lui indique la source de l'image
img.src = "../../assets/images/favicon.ico";
// J'attend le chargement de l'image 
img.onload = ()=>{
    // Je dessine l'image:
    ctx.drawImage(img, 50, 250, 50, 50);
    snapshot = ctx.getImageData(0,0, canvas.width, canvas.height);
}

//? -------------- texte ---------------------
ctx.lineWidth = 1;
// font permet de définir la taille et la police d'écriture
ctx.font = "82px serif";
// strokeText et fillText permettent d'écrire du texte évidé ou rempli.
ctx.strokeText("Coucou", 500, 500);
ctx.fillText("Salut", 500, 300);
// change l'alignement du texte
ctx.textAlign = "center";
// On peut ajouter optionnnelement un dernier paramètre pour limiter la largeur.
ctx.fillText("Salut le monde !", 500, 100, 200);

//? ----------------- forme des trait --------------------

ctx.lineWidth = 16;

ctx.beginPath();
ctx.lineCap = "round";
ctx.moveTo(700, 40);
ctx.lineTo(700, 400);
ctx.stroke();

ctx.beginPath();
ctx.lineCap = "square";
ctx.moveTo(750, 40);
ctx.lineTo(750, 400);
ctx.stroke();

ctx.beginPath();
ctx.lineCap = "butt";
ctx.moveTo(800, 40);
ctx.lineTo(800, 400);
ctx.stroke();


snapshot = ctx.getImageData(0,0, canvas.width, canvas.height);
