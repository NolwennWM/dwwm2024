"use strict";

let tableau = [59, 420, 88, 69, 0, 808, 96];

let tri = new Promise(function(resolve, reject){
    // tableau.sort(function(a,b){
    //     return a-b;
    // })
    for(let i = 1; i<tableau.length; i++)
    {
        if(typeof tableau[i] != typeof tableau[i-1])
        {
            reject("erreur, type incompatible");
        }
    }
    resolve(tableau.sort((a,b)=>a-b));
})

tri.then(e=>console.log(e)).catch(e=>console.log(e));

// Exercice 2 :

function vert()
{
    return new Promise(function(resolve){
        setTimeout(()=>{
            resolve("le feu est vert");
        }, 2000)
    })
}
function rouge()
{
    return new Promise(function(resolve){
        setTimeout(()=>{
            resolve("le feu est rouge");
        }, 2000)
    })
}
function orange()
{
    return new Promise(function(resolve){
        setTimeout(()=>{
            resolve("le feu est orange");
        }, 2000)
    })
}

const feuVert = document.querySelector('.feu1');
const feuOrange = document.querySelector('.feu2');
const feuRouge = document.querySelector('.feu3');

function feuAsynchrone()
{
    vert().then(vert1=>{
        feuVert.style.backgroundColor = "green";
        feuRouge.style.backgroundColor = "black";
        orange().then(orange1=>{
            feuVert.style.backgroundColor = "black";
            feuOrange.style.backgroundColor = "orange";
            rouge().then(rouge1=>{
                feuRouge.style.backgroundColor = "red";
                feuOrange.style.backgroundColor = "black";
                feuAsynchrone();
            })
        })
    })
}
feuAsynchrone();