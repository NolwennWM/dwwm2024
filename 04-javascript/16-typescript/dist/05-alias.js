"use strict";
/*
    J'ai déclaré un type "Fruit" avec le mot clef "type"
    Puis je peux l'utiliser pour typer mes variables
*/
let f = { nom: "Pomme", couleur: "Rouge" };
let aF = [f, { nom: "Banane", couleur: "Verte" }];
let p = { nom: "Maurice", age: 45 };
let n = "George";
let fp = "age";
/*
    "typeof" permet de créer un type qui correspond à un objet précédement créé.
*/
let objet = { vieux: true, prenom: "Maurice", age: 78 };
let o2 = { vieux: false, prenom: "Pierre", age: 24 };
// --------------------- GENERICS -----------------------------
function useless(arg) {
    return arg;
}
let machine = useless("Salut");
/*
    TS ne regarde pas le fonctionnement de votre fonction.
    Si on lui indique une valeur de retour "any"
    Alors la variable à laquelle on attribut notre fonction sera de type "any"

    Mais avec les generics, on peut indiquer à TS
    que le type reçu en argument sera le même que celui de la valeur de retour.
*/
function useful(arg) {
    return arg;
}
let machine2 = useful("Bonjour");
let machine3 = useful(42);
/*
    Ici on indique que ma fonction va utiliser un type particulier.
    Que l'argument est un tableau de ce type
    Mais que la valeur de retour est juste ce type.
*/
function lastOf(arr) {
    return arr[arr.length - 1];
}
let last1 = lastOf([24, 45, 12]);
let last2 = lastOf(["a", "b", "c"]);
/*
    Ici j'indique que le type reçu en argument,
    doit obligatoirement possèder la propriété length.
*/
function logSize(arg) {
    console.log(arg.length);
    return arg;
}
let size1 = logSize([45]);
let size2 = logSize("Test");
// let size3 = logSize(54);
logSize({ nom: "Charlie", length: 145 });
