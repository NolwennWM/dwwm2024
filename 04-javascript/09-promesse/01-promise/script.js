"use strict";

for(let i = 0; i <= 1_000_000_000; i++)
{
    if(i === 1_000_000_000)
    {
        console.log("Synchrone : Boucle Terminé");
    }
}
console.log("Bonjour après la boucle");
/* 
    Par défaut, le code JS est "Synchrone"
    C'est à dire qu'il attend la fin d'une instruction avant de passer à la suivante.

    Mais JS peut gérer la programmation "Asynchrone"
    Dans ce cas, une fois qu'une instruction asynchrone est lancé, 
    la suivante est évalué malgré que la précédente ne soit pas terminé

    C'est le cas avec "fetch" et autre fonction utilisant "then()"
*/
fetch("test.json").then(r=>{
    for(let i = 0; i <= 1_000_000_000; i++)
    {
        if(i === 1_000_000_000)
        {
            console.log("Asynchrone : Boucle Terminé");
        }
    }
})
console.log("Bonjour après le fetch");

/* 
    Une fonction peut ne rien retourner (console.log par exemple)
    Ou bien retourner quelque chose (parseInt() retourne un string)

    Il s'avère que fetch retourne bien quelque chose, une promesse
*/
let request = fetch("test.json");
console.log(request);
/* 
    L'objet promesse représente une valeur qui va venir mais qui peut prendre du temps.
    Avec fetch par exemple, on ne sait pas combien de temps le serveur mettra à répondre.

    Il contient 3 méthodes :
        .then() qui va prendre une fonction callback qui sera appelé une fois la promesse tenue (réussite)
        .catch() qui va prendre une fonction callback qui sera appelé une fois la promesse rejeté (échoué)
        .finally() qui va prendre une fonction callback qui sera appelé une fois la promesse traitée (réussite ou echec)
*/
// la fonction callback reçoit la réponse de la requête
request.then(res=>console.log("then", res));
// La fonction callback reçoit l'erreur de la requête
request.catch(err=>console.log("catch", err));
// la fonction callback ne recoit rien
request.finally(()=>console.log("finally"));

/* 
    Il est possible de résoudre plusieurs promesses en même temps.
    Pour cela on fera appel à la méthode ".all()" de l'objet "Promise"
    Méthode à laquelle on donnera un tableau de toute les promesses que l'on souhaite résoudre.
*/
let r1 = fetch("test.json");
let r2 = fetch("test2.json");
Promise.all([r1, r2]).then(handleFetches);

function handleFetches(responses)
{
    // avec ".all()" la réponse récupéré par then, est un tableau contenant les réponses à toute les promesses
    console.log(responses);
    responses.forEach(resp=>{
        if(resp.ok)
        {
            resp.json().then(data=>console.log(data.prop));
        }
    })
}
/* 
    Avec le même fonctionnement, on trouvera "Promise.race()" et "Promise.any()"
    Mais au lieu de rendre toute les promesses, elles ne rendront que la plus rapide à s'executer.
    .race() lancera le catch si la plus rapide, échoue.
    .any() lancera le catch, si absolument toute les promesses échoues.

    On peut créer nos propres promesses, pour cela il est important de bien comprendre le principe de callback.

    Lorsque l'on créer une promesse, on peut lui donner une fonction callback qui prend 2 arguments.
    Le premier représente la fonction callback de then,
    le second la fonction callback de catch
*/
let random = new Promise(function(resolve, reject){
    let r = Math.random();
    if(r <0.5)
    {
        // appeler la première fonction déclenchera le "then"
        resolve("Bravo ma promesse a réussie");
    }
    else
    {
        // appeler la seconde fonction, déclenchera le "catch"
        reject("Malheureusement la promesse est rompu");
    }
});
random  .then(res=>console.log("then", res))
        .catch(err=>console.log("catch", err))
        .finally(()=>console.log("Ma promesse random est terminé"));

// Exemple burger :
// En version synchrone :
function burgerSynchrone()
{
    painS();
    sauceS();
    viandeS();
    saladeS();
    console.log("Le burger est terminé");
}
function painS(){setTimeout(()=>console.log("le pain est grillé"), 1000)}
function sauceS(){console.log("La sauce est versé");}
function viandeS(){setTimeout(()=>console.log("la viande est cuite"), 3000)}
function saladeS(){console.log("La salade est placée");}
// burgerSynchrone();

// Avec promesse :
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
function burgerAsynchrone()
{
    painA().then(pain=>{
        console.log(pain);
        sauceA().then(sauce=>{
            console.log(sauce);
            viandeA().then(viande=>{
                console.log(viande);
                saladeA().then(salade=>{
                    console.log(salade);
                    console.log("Le burger est terminé");
                })
            })
        })
    })
}
burgerAsynchrone();