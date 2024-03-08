"use strict";

function test(e)
{
    console.log(e);
}
const h1 = document.querySelector('header > h1');
/* 
    Lorsqu'un utilisateur intéragie avec la page,
    cela produit un évènement (scroll, clique, mouvement, clavier...)

    Nous allons pouvoir indiquer à JS d'écouter ces évènements, 
    et lorsqu'il en entend un, de produire une action en réponse.

    3 solutions pour écouter un évènement, la première étant :
    ".addEventListener()"
    On indiquera en premier argument, le nom de l'évènement à écouter (en minuscule)
    En second, la fonction à lancer lors de cet évènement.
*/
h1.addEventListener("click", test);
/* 
    Par défaut, js donne en argument d'une fonction d'évènement,
    un objet contenant des informations sur l'évènement.
    pour un clique, un objet "click" avec entre autre, la cible du clique, sa position x et y...

    On peut ajouter autant d'écouteur d'évènement que souhaité sur un même élément.
    On peut utiliser en callback des fonctions anonyme ou fléché
*/
h1.addEventListener("click", function(e)
{
    let r = Math.floor(Math.random()*360);
    e.target.style.transform = `rotate(${r}deg)`;
});

/* 
    On peut aussi ajouter un évènement via la propriété qui correspond.
    Chaque élément HTML a de multiples propriétés commençant par "on" suivi du nom de l'évènement (onclick, onload...)
    Si cette proprité est définie avec une fonction, l'effet sera le même
*/
const menu1 = document.querySelector('.menu1');
console.log(menu1);

menu1.onclick = test;
// On ne peut ajouter qu'un seul évènement d'un même type via l'attribut
menu1.onclick = (e)=>{
    if(e.target.style.fontSize === "")
    {
        e.target.style.fontSize = "2em";
    }else
    {
        e.target.style.fontSize = "";
    }
};
/* 
    La troisième façon d'ajouter un évènement, est de le faire directement dans le html (voir "menu2")

    Si on souhaite supprimer un évènement :
*/
menu1.onclick = "";
h1.removeEventListener("click", test);
/* 
    Petit défaut, on ne peut retirer que les eventListener où l'on utilise une fonction nommé.
*/
// ? ---------------------- Options --------------------------

const btn1 = document.querySelector('.div1 button');
const input1 = document.querySelector('.div1 input');
/* 
    On peut ajouter des options au addEventListener.
    Pour cela on donnera en troisième argument, un objet contenant ces options.

    l'option "once" permet de ne déclencher un évènement qu'une seule fois.
*/
btn1.addEventListener("click", ()=>h1.textContent=input1.value, {once:true});
/* 
    Si plusieurs évènements sont déclenché par une même action,
    Alors l'ordre sera défini du parent le plus proche au plus éloigné.

    JS fonctionne en deux phases, une phase de "capture" où il vérifie les évènements à déclencher, allant des parents vers les enfants.
    Et une phase de "bulle" qui remonte des enfants vers les parents en activant les évènements.
*/
const div4 = document.querySelector('.div4');
const gp = div4.querySelector('.grandParent');
const pa = div4.querySelector('.parent');
const en = div4.querySelector('.enfant');
/* 
    Avec l'option "capture" à true,
    Nous indiquons à un évènement de se déclencher pendant la phase de capture,
    donc avant les autres.
*/
div4.addEventListener("click", ()=>console.log("div 4"), {capture: true});
gp.addEventListener("click", ()=>console.log("Grand Parent"));
pa.addEventListener("click", (event)=>{
    console.log("Parent");
    event.stopPropagation();
});
en.addEventListener("click", ()=>console.log("Enfant"));
/* 
    La méthode d'évènement ".stopPropagation()" 
    permet d'arrêter une suite d'évènement.

    La méthode d'évènement ".preventDefault()"
    permet de désactiver l'évènement par défaut d'un élément HTML.
    (la soumission d'un formulaire, l'activation d'un lien...)
*/
const menu5 = document.querySelector('.menu5 a');
menu5.addEventListener("click", e=>e.preventDefault());