"use strict";
/*
    Créer un élément h1 en TS, et l'afficher dans le HTML
    telle que :
    <h1>Le double de la valeur de l'input de type number est : {double de la valeur de l'input}</h1>

    Ajouter un évènement pour que le h1 change avec l'input
*/
const title = document.createElement("h1");
const valeur = document.querySelector("input");
document.body.append(title);
valeur.addEventListener("input", () => {
    let valeurDouble = parseInt(valeur.value) * 2;
    title.textContent = `Le double de l'input est : ${valeurDouble.toString()}`;
});
