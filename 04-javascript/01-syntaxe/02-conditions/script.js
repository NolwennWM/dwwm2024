"use strict";
/* 
    Math.random() retourne un chiffre entre 0 et 1
    Math.floor() arrondi à l'inferieur
*/
let x = Math.floor(Math.random()*20);
console.log(x);

/* 
    Une condition commencera obligatoirement par un "if"
    il sera suivi de parenthèse contenant la condition.
    Puis d'accolade contenant l'instruction à réaliser.

    Si la condition est "true" alors l'instruction sera réalisé.
    Si c'est "false", elle sera ignoré.
*/
if(x < 10)
{
    console.log("x est plus petit que 10");
}
/* 
    On pourra optionnellement faire suivre notre if d'autant de "else if(){}" que l'on souhaite,
    Ce sont des conditions supplémentaires qui seront vérifié uniquement si toute les précédentes sont fausse.
*/
else if(x > 10)
{
    console.log("x est plus grand que 10");
}
/* 
    On peut optionnellement terminer une condition par un "else{}"
    Celui ci ne prend pas de condition, et s'executera si tout ce qui le précède est faux.
*/
else
{
    console.log("x vaut 10");
}
/* 
    Si une condition ne prend qu'une seule instruction,
    On peut l'écrire sans accolade :
*/
if(x < 10)
    console.log("x est plus petit que 10");
else if(x > 10)
    console.log("x est plus grand que 10");
else
    console.log("x vaut 10");

/* 
    Si votre condition est assez simple, on peut l'écrire en une seule instruction,
    sous la forme d'une ternaire. Sa syntaxe est la suivante: 
    condition ? true : false;
*/
let message = x <= 10 ? "x est plus petit ou égale à 10": "x est plus grand que 10";
console.log(message);

// ? ---------------- SWITCH ---------------------
// prompt affiche une boîte de dialogue où l'utilisateur peut rentrer un texte
let ville = prompt("De quel ville venez-vous?");
console.log(ville);
// Si l'utilisateur a annulé, on obtient "null"
if(ville === null) ville = "sans réponse";

/* 
    le switch prend une valeur à comparer avec ses différents cas.
    Il ira vérifier si il possède un "case" correspondant à la valeur entre ses parenthèses.

    Chaque case doit se terminer par un "break" sinon l'instruction suivante sera réalisé.

    .toLowerCase() permet de transformer un texte en sa version "minuscule"
*/
switch(ville.toLowerCase())
{
    case "lille":
        console.log("Vive le maroille");
        break;
    case "londres":
    case "tokyo":
    case "paris":
        console.log("Une capitale donc");
        break;
    default:
        console.log("Je ne connais pas cette ville");
} 
// ? --------- Opérateur de chainage optionnelle (?.) ----------

let obj1 = {info: "Cet objet est un exemple"},
    obj2 = {},
    obj3 = null;
/* 
    Ajouter un "?" avant de tenter de chaîner une propriété,
    permet de vérifier si la propriété précédente existe belle et bien.
    Cela peut éviter des erreurs lorsque le contenu d'un objet peut varier.
*/
console.log(obj1.info.toUpperCase());
console.log(obj2.info?.toUpperCase());
console.log(obj3?.info?.toUpperCase());
/* 
    if(ville === null) ville = "sans réponse";
    switch(ville.toLowerCase())
    remplaçable par :
    switch(ville?.toLowerCase())
*/
// ? --------- Opérateur de Coalescence (??) ---------------

let a, b = undefined, c = null, d = "J'aime les crèpes";
/* 
    L'opérateur de coalescence va vérifier si la valeur précédente n'est pas "null" ou "undefined".
    Si elle existe alors elle est affiché, sinon c'est la valeur suivante qui est utilisé.
*/
console.log(
    a ?? "a n'existe pas",
    b ?? "b n'existe pas",
    c ?? "c n'existe pas",
    d ?? "d n'existe pas"
);
/* 
    if(ville === null) ville = "sans réponse";
    remplaçable par :
    ville = ville ?? "sans réponse";
*/