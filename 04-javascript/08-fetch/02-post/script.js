"use strict";

const url = "https://api.thedogapi.com/v1/images/upload";
const api_key = "live_U8C8pGOECtGkpLTkSJJ6QIBrZs0qC2gUTXObqsc40bpMn0KfQfVaPfoTgmPl9zFv";

const formulaire = document.querySelector('form');
const result = document.querySelector('.result');

formulaire.addEventListener("submit", uploadDog);

function uploadDog(e)
{
    e.preventDefault();
    result.textContent = "Chargement en cours";

    const formData = new FormData(formulaire);
    /* 
        Le deuxième argument de fetch, permet de lui ajouter des options.
        On pourra y trouver :
            la methode à utiliser,
            les headers de la requête,
            le corps de la requête
    */
    fetch(url,{
        method: "POST",
        headers: {"x-api-key": api_key},
        body: formData
    }).then(checkResponse);
}
function checkResponse(response)
{
    result.textContent = "Chargement Terminé !";
    if(response.ok)
    {
        response.json().then(data=>{
            result.innerHTML = `<hr><img src="${data.url}" alt="photo de chien" width="400">`;
        })
    }else
    {
        result.textContent = response.statusText;
    }
}