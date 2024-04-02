"use strict";

/* 
    Le shadow DOM permet de créer un arbre DOM séparé du reste du DOM.
    Ce DOM fantôme obéit à ses propres règles, ignorant les scripts et styles appliqués au DOM parent.
    De même, les scripts et styles appliqués au DOM fantôme, n'influeront pas le DOM parent.

    Pour créer un "hôte fantôme (shadow host)", il suffit d'appeler la méthode "attachShadow" sur l'élement qui doit accueillir le shadow DOM.
        * elementHTML.attachShadow({mode:""});
        Le mode peut être "open" ou "closed"

        En mode "open" le shadowDOM est accessible depuis l'élément HTML
        En mode "closed" le shadowDOM n'est accessible qu'avec la valeur retourné par attachShadow.
*/
const open = document.querySelector('.open');
const close = document.querySelector('.close');

const shadowpen = open.attachShadow({mode:"open"});
const shadowclose = close.attachShadow({mode:"closed"});

// Accessible dans tous les cas :
console.log(shadowpen, open.shadowRoot);
// Non accessible via la propriété shadowRoot :
console.log(shadowclose, close.shadowRoot);

/* 
    Dans l'exemple suivant, chacun des 3 h1 ne sont affecté que par le style de leur DOM.

    Pour l'exemple, j'utilise des feuilles de style interne, mais on pourrait y lier des feuilles externe.

    Le selecteur CSS ":host" correspondra à l'hôte de notre shadow DOM (ici les div .open et .close)
*/
const style1 = document.createElement("style");
style1.textContent = /*CSS*/
    `
    :host{ text-align: right;}
    h1{ background-color: black;}
    `;
const h01 = document.createElement("h1");
h01.textContent = "Je vois des fantômes dans les ombres";
shadowpen.append(style1, h01);

const style2 = document.createElement("style");
style2.textContent = /*CSS*/
    `
    :host{ text-align: center;}
    h1{ text-shadow: 5px 5px 5px red;}
    `;
const h02 = document.createElement("h1");
h02.textContent = "Mon ombre cache un fantôme";
shadowclose.append(style2, h02);

/* 
    Si je tente de selectionner tous les h1 du document,
    Seul ceux hors d'un shadow dom seront selectionné.

    Pour selectionner un élément du shadow dom, il me faut rechercher directement dans celui ci
*/
const hx = document.querySelectorAll("h1");
console.log(hx);    

const hx1 = shadowpen.querySelectorAll('h1');
const hx2 = shadowclose.querySelectorAll('h1');
console.log(hx1, hx2);

// Maintenant, lions nos customs elements avec notre shadow dom:
import SuperBalise from "./superBalise.js";