"use strict";
/* 
    ? -------------- DOM --------------
    Le DOM ou Document Object Model est une réprésentation sous la forme d'un objet de notre document HTML.
    Il est souvent représenté comme un arbre dont chaque balise sont les branches.

    Dans JS chaque élément HTML sera représenté par un objet aux nombreuses propriétés.

    Les fonctionnalités de base passeront par l'objet "document"
*/
console.log(document);
// sous chrome, on utilisera plutôt console.dir() pour avoir le détail de l'objet
/* 
    La méthode ".createElement()" de l'objet "document"
    permet de créer un objet représentant une balise HTML.
    Il prendra en paramètre, un string indiquant le nom de la balise à créer.
*/
const h = document.createElement("header");
console.log(h);
/* 
    L'élément a été créé dans la variable, mais n'existe pas encore dans la page.
*/
const m = document.createElement("main");
const f = document.createElement("footer");
// Je peux modifier le contenu HTML d'une balise avec la propriété ".innerHTML"
h.innerHTML = "<h1>Super Site en JS</h1>";
f.innerHTML = /* html */ `<ul><li>Menu 1</li><li>Menu 2</li><li>Menu 3</li></ul>`;

console.log(document.body);
/* 
    Par défaut le body sera "null" car le script lancé avant que le navigateur rencontre la balise body.

    Pour corriger cela, deux solutions :
        - Soit placer le script en bas de page.
        - Soit placer l'attribut "defer" sur le script pour lui indiquer d'attendre la fin du chargement de la page avant de lancer le script.

    Cela peut être une bonne chose de vérifier  l'existence d'un élément avant de travailler avec :
*/
if(document.body)
{
    /* 
        La méthode ".append()" permet d'insérer des éléments HTML (ou du texte) dans l'élément HTML qui la précède.
        les éléments sont ajouté à la fin de la balise.
        On peut utiliser ".prepend()" pour ajouter au début de celle ci.
    */
    document.body.append(h, m, f);
}
for(let i = 0; i < 5; i++)
{
    const p = document.createElement("p");
    /* 
        ".textContent" permet d'ajouter du texte à un élément HTML.
        Seulement les balises HTML ne seront pas interprétées.
        Cela sera utile lorsque notre texte dépend d'une entrée utilisateur, 
        afin d'éviter qu'il injecte sont propre code.
    */
    p.textContent = "<strong>bla bla bla</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque culpa blanditiis dignissimos, non vel similique dolorum deleniti quae libero hic, ex dolores sed, vitae magnam eos fugit. Suscipit, praesentium numquam.";
    /* 
        ".appendChild" fonctionne comme ".append" si ce n'est qu'il ne peut prendre qu'un element HTML à la fois.
    */
    m.appendChild(p);
}