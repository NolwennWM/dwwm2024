"use strict";
/* 
    JSON signifie Javascript Object Notation
    C'est un langage qui permet de stocker des informations complexes (tableau, objet...) sous la forme d'un string.
    Ainsi que de transférer des données entre deux langages qui ne pourraient pas se comprendre autrement. (JS et PHP)
*/

const form = document.querySelector('form');

form.addEventListener("submit", saveData)

function saveData(event)
{
    // J'empêche la soumission du formulaire
    event.preventDefault();
    // Je transfère les données de mon formulaire à l'objet "FormData"
    const data = new FormData(form);

    let user = {};
    // Je parcours mon formulaire pour en récupérer les "name" et "value"
    data.forEach((value, name)=>{
        console.log(value, name);
        user[name] = value;
    })
    // J'obtient un objet contenant les values et name de mon formulaire
    console.log(user);

    showUser(user);
    // Avec JSON.stringify() je transforme des donnés en format JSON
    const strUser = JSON.stringify(user);
    console.log(strUser);
    // Je peux donc stocker mon objet sous forme JSON (string) 
    localStorage.setItem("user", strUser);
}

function showUser(u)
{
    const h1 = document.querySelector('h1');
    h1.textContent = `Je suis ${u.prenom}, ${u.age} ans !`;
}

const userString = localStorage.getItem("user");
if(userString)
{
    console.log(userString);
    // Je transforme un string JSON en objet javascript
    const user = JSON.parse(userString);
    console.log(user);
    showUser(user);
}