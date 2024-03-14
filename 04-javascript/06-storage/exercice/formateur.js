"use strict";
/* 
    1. Ajouter un menu de selection qui permettra de choisir entre 3 thèmes.
    2. Appliquer le thème selectionné grâce à JS (pas besoin de thème compliqué)
    3. Faire en sorte que le choix de l'utilisateur soit toujours appliqué lorsqu'il change de page. (que ce soit visible dans le menu de selection autant que dans les couleurs du site.)
    4.Bonus. Faire un bouton qui change aléatoirement les couleurs du site et les sauvegarder.
*/

const select = document.querySelector('#themes');

select.addEventListener("input", switchTheme);

function switchTheme(){
    switch(select.value){
        case "rose":
            document.documentElement.style.setProperty("--fond", "pink");
            document.documentElement.style.setProperty("--text", "purple");
            break;
        case "bleu":
            document.documentElement.style.setProperty("--fond", "cyan");
            document.documentElement.style.setProperty("--text", "blue");
            break;
        case "tortue":
            document.documentElement.style.setProperty("--fond", "greenyellow");
            document.documentElement.style.setProperty("--text", "green");
            break;
    }
    localStorage.setItem("theme", select.value);
}
function loadTheme(){
    let t = localStorage.getItem("theme");
    if(t){
        let option = select.querySelector(`[value="${t}"]`);
        if (option) {
            option.selected= true;
            switchTheme();
            // bonus uniquement :
            return;
        }
    }
    // bonus uniquement :
    let text = localStorage.getItem("text");
    let fond = localStorage.getItem("fond");
    if(text && fond)
    {
        document.documentElement.style.setProperty("--fond", fond);
        document.documentElement.style.setProperty("--text", text);
    }
}
loadTheme();

// Bonus :
const rand = document.querySelector('.randColor');
rand.addEventListener("click", randomize);
function randomize()
{
    let text = randColor();
    let fond = randColor();
    localStorage.removeItem("theme")
    localStorage.setItem("text", text);
    localStorage.setItem("fond", fond);
    document.documentElement.style.setProperty("--fond", fond);
    document.documentElement.style.setProperty("--text", text);
}
function randColor(){
    let rgb = [];
    for(let i = 0; i<3; i++){
        let c = Math.floor(Math.random()*256);
        rgb.push(c);
    }
    return `rgb(${rgb[0]},${rgb[1]},${rgb[2]})`;
}