"use strict";
// ? --------------- While -----------------
let a = true;
/* 
    while va vérifier une instruction entre parenthèse.
    Tant que celle ci sera vrai, il répètera le code entre accolade.
    ! ATTENTION 
        Lorsque vous faites une boucle, prévoyez toujours une condition de sortie.
        Le navigateur pourra facilement gérer des centaines voir millier de boucle, mais si il en fait à l'infinie, il plantera.
*/
while(a)
{
    console.log("Coucou");
    a = Math.random() < 0.5;
}
let b = 0;
while(true)
{
    b++
    if(b < 10)
    {
        // Met fin à l'iteration actuelle de la boucle, et passe à la suivante
        continue;
    }
    if(b == 20)
    {
        // Met fin à la boucle.
        break;
    }
    console.log("b vaut ", b);
}

// Do while va effectuer l'instruction une première fois, avant de vérifier si elle doit être répété.
do
{
    console.log("do while vaut", b);
}while(b < 5)

// ? -------------- For -----------------
/* 
    for va prendre 3 instructions entre ses parenthèses.
        - La première, souvent une déclaration de variable, est évalué avant la boucle.
        - La seconde, est la condition pour continuer la boucle.
        - La troisième est évalué à chaque fin d'itération.
*/
for(let i = 0; i<10; i++)
{
    console.log("i vaut ", i);
}

let arr = ["pizza", "cannelé", "gratin dauphinois"];
let person = {nom: "Pierre", age: 55, yeux: "vert"};
/* 
    La boucle for in va créer une itération pour chaque propriété ou index d'un objet / tableau.
    La variable déclaré entre parenthèse prenant à chaque itération la valeur correspondante à la propriété ou l'index suivant.
*/
for(let food in arr)
{
    console.log("food vaut ", food);
    console.log(food, " -> ", arr[food]);
}
for(let carac in person)
{
    console.log("carac vaut ", carac);
    console.log(carac, " -> ", person[carac]);
}
/* 
    le "for of" fonctionne de la même manière que "for in"
    Seulement, il n'est utilisable que sur les tableaux.
    Et retourne à chaque itération, non pas l'index, mais directement la valeur.
*/
for (let f of arr) 
{
    console.log("f vaut ", f);    
}
/* 
    Il existe d'autres boucles réservés aux tableaux.
    comme forEach, map, reduce... 
    Mais il faut d'abbord comprendre le principe de "fonction callback"
*/

