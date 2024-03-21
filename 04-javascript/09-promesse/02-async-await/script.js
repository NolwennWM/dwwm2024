"use strict";
// Récupération classique d'un fichier json :

fetch("tab.json").then(res=>{
    if(res.ok)
    {
        res.json().then(data=>{
            console.log(data);
        })
    }
})
/* 
    Quand on utilise les promesses, on peut vite se retrouver dans ce qu'on appelle un "callback hell";
    C'est à dire des callback dans des callback et ainsi de suite.
    Cela peut rendre la lecture du code compliqué.

    C'est pour cela que JS implémente les mots clefs "async" et "await"
    Le mot clef "async" se place devant la déclaration d'une fonction.
        Cela rendra la fonction asynchrone.
    Le mot clef "await" se place devant l'appel d'une fonction retournant une promesse.
        Il indique au code d'attendre le résultat de la promesse avant de continuer.
    ! await ne peut être utilisé que dans une fonction "async"
*/
async function exemple()
{
    // console.log(await fetch("tab.json"), fetch("tab.json"));
    let response = await fetch("tab.json");
    if(!response.ok)return;
    let data = await response.json();
    console.log(data);
}
exemple();
/* 
    Petit défaut de cette technique, c'est que le "catch"
    n'est pas géré.
    On pourra le gérer en plaçant le tout dans un try catch

    Les fonctions asynchrones se mettent à retourner automatiquement une promesse :
*/
function synchrone(){return "coucou";}
async function asynchrone(){return "coucou";}
console.log(synchrone(), asynchrone());

// Retour du burger :

async function burger()
{
    console.log(await painA());
    console.log(await sauceA());
    console.log(await viandeA());
    console.log(await saladeA());
    console.log("Mon burger est terminé!");
}
burger();
// fonctions du cours précédent :
function painA()
{
    return new Promise(function(resolve){
        setTimeout(()=>{
            resolve("Le pain est grillé");
        }, 1000)
    })
}
function sauceA()
{
    return new Promise(function(resolve){
        resolve("La sauce est versée");
    })
}
function viandeA()
{
    return new Promise(function(resolve){
        setTimeout(()=>{
            resolve("La viande est cuite");
        }, 3000)
    })
}
function saladeA()
{
    return new Promise(function(resolve){
        resolve("La salade est placée");
    })
}