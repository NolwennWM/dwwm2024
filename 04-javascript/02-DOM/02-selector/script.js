"use strict";
/* 
    ".getElementsByTagName" permet de récupérer tous les éléments HTML dont le nom de la balise est donné en argument.

    Peu importe qu'il y ai un ou plusieurs résultats, ils sont rangé dans un objet appelé "HTMLCollection".

    Il fonctionnera comme un tableau, si je veux mon premier objet, 
    je taperais "[0]"
*/
const lis = document.getElementsByTagName("li");
console.log(lis, lis[0]);
// On ne peut pas changer tous les éléments d'un seul coup, il faut le faire un à un
lis[0].textContent = "J'ai changé le texte en JS";
/* 
    ".getElementsByClassName" fonctionne comme le précédent,
    si ce n'est qu'il selectionne les éléments par leur nom de classe.
*/
const ps = document.getElementsByClassName("step");
const p1 = document.getElementsByClassName("marche1");
console.log(ps, p1);
/* 
    ".getElementById" selectionne un élément par son id.
    l'id devant être unique dans une page, 
    pas de HTMLCollection ici, on obtient directement l'élément.
*/
const h1 = document.getElementById("mainTitle");
console.log(h1);
/* 
    ".querySelector" prend en paramètre sous la forme d'un string,
    un selecteur CSS.
    Il ira selectionner le premier élément qui correspond à ce selecteur
*/
const p2 = document.querySelector(".marche2");
// const p2 = document.querySelector("main > p:nth-of-type(2)");
// const p2 = document.querySelector("body main>p.marche2.step");
console.log(p2);
/* 
    ".querySelectorAll" fonctionne comme le précédent
    Si ce n'est qu'il rangera dans un tableau "NodeList" tous les éléments correspondant au selecteur CSS.
*/
const lis2 = document.querySelectorAll("footer li");
console.log(lis2);
/* 
    J'ai recherché à chaque fois dans le document en entier.
    Mais on peut préciser notre recherche sur un élément précis :
*/
const header = document.querySelector('header');
// Ici je recherche uniquement dans le header
const h = header.querySelector('h1');

// ? ---------------- Selecteur bonus -------------------
// Selectionne le prochain élément frère en HTML
console.log(header.nextElementSibling);
// Selectionne ce qui suis en HTML (ici un saut à la ligne et une indentation)
console.log(header.nextSibling);
// Selectionne l'élément frère précédent en HTML
console.log(lis[2].previousElementSibling);
// Selectionne tous les enfant direct dans un objet HTMLCollection
console.log(header.children);
// Selectionne le parent de l'élément HTML
console.log(lis[2].parentElement);
// Selectionne le parent le plus proche, correspondant au selecteur CSS
console.log(lis[2].closest("footer"));

// ? ------------- Supprimer ou Déplacer --------------------
// Pour déplacer un élément, il suffit de l'append ailleurs:
header.append(lis[0]);
// Pour supprimer un élément, on pourra utiliser ".remove()"
lis[2].remove();
// Il est supprimé du HTML mais existe toujours dans notre variable :
console.log(lis[2]);

// Il existe aussi pour supprimer :
// header.removeChild(h);