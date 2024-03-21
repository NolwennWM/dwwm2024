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