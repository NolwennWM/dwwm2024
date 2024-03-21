"use strict";
let a1 = [5,12, 8];
let a2 = [7, "27", 9];
// a1.sort();
// console.log(a1);
a1.sort((a,b)=>{
    console.log(a,b);
    return a-b;
})
console.log(a1);

function tri(tab){
    return new Promise((resolve, reject)=>{
        tab.sort((a,b)=>{
            if(typeof(a) !== typeof(b)){
                reject("Tous les éléments du tableau ne sont pas de même type.");
            }
            return a-b;
        })
        resolve("Le tableau a été correctement trié");
    });
}
tri(a1).then(message=>console.log(message))
        .catch(error=>console.error(error));
tri(a2).then(message=>console.log(message))
        .catch(error=>console.error(error));
/**
 * EXO 2:
 * Créer un feu de circulation qui restera 3 seconde au vert
 *      PUIS qui restera 1 seconde au jaune,
 *      PUIS qui restera 2 seconde au rouge.
 *      PUIS se répètera à nouveau.
 * Tout cela à l'aide de promesse.
 */

const lights = document.querySelectorAll('#trafficLight > div');

function changeColor(index, resolve){
    let colors = ["red", "yellow", "green"];
    lights.forEach((l, i)=>{
        l.style.backgroundColor = i != index ? "": colors[i]
    })
    resolve();
}
function switchPromise(time, i){
    return new Promise(resolve=>{
        setTimeout(changeColor, time, i, resolve);
    })
}

function step(){
    switchPromise(2000, 2)
        .then(()=>switchPromise(3000, 1))
        .then(()=>switchPromise(1000, 0))
        .then(()=>step());
}
step()