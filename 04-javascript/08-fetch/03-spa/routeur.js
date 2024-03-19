"use strict";
const main = document.querySelector('main');
const liens = document.querySelectorAll('a');
/* 
    J'indique en clef les routes de ma SPA
    et en valeur les fichiers à charger :
*/
const routes = {
    "/":"pages/home.html",
    "/index.html":"pages/home.html",
    "/about":"pages/about.html",
    "/contact":"pages/contact.html",
    404:"pages/404.html",
};

setLinks(document);
loadPage();

function setLinks(parent)
{
    const tags = parent.querySelectorAll('a:not([href^="https"])');
    tags.forEach(a=>a.addEventListener("click", router));
}
/**
 * Gère le routing de ma SPA
 * @param {Event} e 
 */
function router(e)
{
    // Je préviens l'activation des liens
    e.preventDefault();
    // Permet d'ajouter un lien à l'historique et changer l'url visible en haut de page
    window.history.pushState({}, "", e.target.href);

    loadPage();
}
function loadPage()
{
    // On récupère le chemin de la page
    const path = window.location.pathname;
    // console.log(path);
    const route = routes[path] || routes[404];
    // console.log(route);
    fetch("/04-javascript/08-fetch/03-spa/"+route).then(r=>{
        if(!r.ok)return;
        // .text() permet de récupérer des données textuelles
        r.text().then(d=>{
            main.innerHTML = d;
            setLinks(main);
        })
    })
}