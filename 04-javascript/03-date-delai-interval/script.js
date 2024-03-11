"use strict";

const copyright = document.querySelector('footer span');
const mainTime = document.querySelector('main time');
const mainBtn = document.querySelector('main button');
const progress = document.querySelector('.progress');

/* 
    Certains objets de javascript doivent être créer à partir de classe (ou de constructeur)
    Nous rentrons dans les détails sur le cours "POO".

    Pour l'instant, ce qu'il faut savoir, c'est que pour créer ces objets,
    nous devons faire précéder leur nom du mot clef "new".

    Cela va créer une nouvelle instance de cet objet.
    Dans notre cas, nous allons utiliser l'objet "Date"
    qui contiendra l'heure et la date du moment de sa création
*/
const date = new Date();
console.log(date);
// Cet objet contient tout un tas de méthodes pour récupérer les différentes informations sur la date et l'heure :
copyright.textContent = date.getFullYear();
mainTime.textContent = date.toLocaleTimeString();

function timer()
{
    const dateTimer = new Date();
    mainTime.textContent = dateTimer.toLocaleTimeString();
}
/* 
    la fonction setInterval permet de relancer la fonction donné en premier argument,
    au rythme donné en second argument (en ms)

    Elle retourne un id que l'on peut réutiliser ailleurs.
*/
let idInterval = setInterval(timer, 1000);
console.log(idInterval);

// La fonction "clearInterval" permet d'arrêter l'interval dont l'id est donné en argument.
mainBtn.addEventListener("click", ()=>clearInterval(idInterval));

/* 
    setTimeout() fonctionne exactement comme setInterval.
    Elle prend les même paramètres.
    Elle retourne un id qui peut être utilisé pour l'arrêté avec "clearTimeout()"

    La seule différence, c'est qu'au lieu de relancer la fonction à rythme régulier, elle ne la lancera qu'une fois après avoir attendu le délai donné.
*/
let idTimeout = setTimeout(()=>console.log("Coucou en retard"), 3000);

let w = 0;

function load()
{
    if(w === 100)return;
    w++;
    progress.style.width = w+"%";
    setTimeout(load, 100);
}
load();