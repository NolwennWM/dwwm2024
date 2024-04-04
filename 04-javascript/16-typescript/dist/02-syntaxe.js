"use strict";
/*
    Le principal apport de Typescript, c'est dans son nom
    C'est le typage !

    C'est à dire que comme dans de nombreux langages (java, c#...),
    Il va nous falloir indiquer le type de nos variables et arguments
*/
let mot = "Bonjour";
let chiffre = 42;
let bool = true;
let nu = null;
// Si je tente de changer le type d'une variable, j'ai une erreur :
// mot = 5;
// On peut indiquer le type de données contenu par un tableau :
const arr1 = ["Truc", "Bidule"];
// Si une variable ou un tableau peut contenir différent types, je peux utiliser "|"
const arr2 = ["chaussette", 42];
// Si une variable peut contenir n'importe quel type de donnée, je peux utiliser le type "any"
let truc = 5;
truc = true;
const arr3 = ["cela", 42, true];
/*
    Pour typer un objet,
    Il me faudra indiquer le type de chaque propriété
*/
const p1 = { prenom: "Maurice", age: 42 };
// On peut indiquer qu'une propriété est optionnelle "?"
const p2 = { prenom: "Pierre" };
// Si mon objet peut avoir un nombre indéfini de propriété, je peux utiliser :
const p3 = { prenom: "Charle", nom: "Dupont", loisir: "Pétanque" };
// Dans le cas d'une instanciation de classe, on peut utiliser le nom de celle ci
const today = new Date();
// Bien que plus rare, si on met une fonction dans une variable :
const salut = () => { };
/*
    On peut aussi typer les paramètres et valeur de retour de nos fonctions
    le type void en valeur de retour, indique que la fonction ne retourne rien
*/
function clickMe(e) {
    console.log("Merci pour ce clique !", e.target);
}
// La fonction callback s'attend à un évènement de souris.
// document.addEventListener("input", clickMe);
document.addEventListener("click", clickMe);
// On peut indiquer qu'un paramètre est en lecture seule
function tri(arg) {
    // Je ne peux changer mon argument :
    // arg.sort();
    // Je peux changer sa copie :
    const a2 = [...arg].sort();
}
// Si on ne précise pas le type d'une variable, elle prendra le type de sa première valeur :
let a = 5;
// a = "test";
/*
    Certaines fonctions ont plusieurs valeur de retour possible.
    par exemple querySelector retourne "Element" ou "null"
    Cela va poser problème sur plusieurs points :
*/
const btn1 = document.querySelector("#compte");
// btn1.style.color = "red";
/*
    Deux erreurs :
        notre selection est peut être null
        la propriété style n'existe pas sur Element.
    Bien que l'on sache que l'on vise un HTMLElement,
    querySelector nous précise seulement que c'est un Element.

    Plusieurs solutions à ces problèmes :
    le "!" à la fin fait disparaître la possibilité de "null"
*/
const btn2 = document.querySelector("#compte");
// btn2.style.color = "red";
/*
    Mais on a encore le problème de "Element"
    avec "<>" devant les parenthèses, on change la valeur de retour
*/
const btn3 = document.querySelector("#compte");
// btn3.style.color = "red";
/*
    Cette solution règle le problème de "Element" qui n'a pas la propriété style
    Mais pas celle du "null"

    On peut combiner les deux solutions précédentes ou bien utiliser l'une de celles ci :
*/
// const btn4 = <HTMLButtonElement>document.querySelector("#compte");
const btn4 = document.querySelector("#compte");
btn4.style.color = "red";
/*
    On pourrait aussi utiliser le narrowing qui sera le thème de la prochaine partie.
*/ 
