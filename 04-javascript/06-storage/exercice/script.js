"use strict";
/* 
    1. Ajouter un menu de selection qui permettra de choisir entre 3 thèmes.
    2. Appliquer le thème selectionné grâce à JS (pas besoin de thème compliqué)
    3. Faire en sorte que le choix de l'utilisateur soit toujours appliqué lorsqu'il change de page. (que ce soit visible dans le menu de selection autant que dans les couleurs du site.)
    4.Bonus. Faire un bouton qui change aléatoirement les couleurs du site et les sauvegarder.
*/
const selectColor = document.querySelector("#colorTheme");

function selectTheme()
{
    document.body.classList.remove("blue", "green", "orange");
    if(selectColor.value == "blue")
    {
        document.body.classList.add("blue");
        localStorage.setItem("themes", "blue");
    }
    if(selectColor.value == "green")
    {
        document.body.classList.add("green");
        localStorage.setItem("themes", "green");
    }
    if(selectColor.value == "orange")
    {
        document.body.classList.add("orange");
        localStorage.setItem("themes", "orange");
    }
}
selectColor.addEventListener("change", selectTheme);

const item = localStorage.getItem("themes");
selectColor.value = item;
selectTheme();

// aléatoire :

const randomTheme = document.querySelector("#randomTheme");
randomTheme.addEventListener("click", themeRandom);

function themeRandom(e)
{
    document.body.className = "";
    let color1 = localStorage.getItem("color1");
    let color2 = localStorage.getItem("color2");
    if(e != undefined)
    {
        color1 = Math.floor(Math.random()*333);
        color2 = Math.floor(Math.random()*333);
    }

    document.documentElement.style.setProperty("--fond", "#"+color1);
    document.documentElement.style.setProperty("--text", "#"+color2);
    localStorage.setItem("color1", color1);
    localStorage.setItem("color2", color2);    
}
themeRandom();