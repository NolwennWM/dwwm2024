/* 
    Exercice 1 :
    Changer la taille de la police de chaque paragraphe du main.
    chaque paragraphe doit être plus gros que le précédent.
*/
const paragraphe = document.querySelectorAll("main p");
for(let i = 0; i < paragraphe.length; i++)
{
    paragraphe[i].style.fontSize = (1+i)+ "rem";
}
/* 
    Exercice 2 :
    Faite apparaître la modale via une transition depuis la gauche. 
*/
const modale = document.getElementsByTagName("aside")[0];
modale.style.transition = "left 1s linear";
modale.style.left = "50%";
/* 
    Exercice 3 :
    Faite que la couleur de fond de la modale soit aléatoire à chaque rechargement de la page.
*/
const dv = document.querySelector("div");

function bgColor()
{
    var x = Math.floor(Math.random()*256);
    var y = Math.floor(Math.random()*256);
    var z = Math.floor(Math.random()*256);
    var bg = "rgb(" + x + ","+y+","+z+")";
    // var bg = `rgb(${x}, ${y}, ${z})`
    dv.style.backgroundColor = bg;
}
bgColor();