"use strict";

/* 
    Lorsque l'on veut récupérer des données depuis un autre fichier, ou bien depuis une API.
    Nous avons besoin que JS envoi une requête (de préférence asynchrone) à ce fichier (ou au site de l'api).
    Pour cela deux solutions :
        - Le plus ancien XMLHttpRequest();
        - Le plus récent fetch();
*/
const url = "./hero.json";
// ? ------------ XMLHttpRequest() --------------
// Je crée un nouvel objet :
const xmlhttp = new XMLHttpRequest();
// Je lui ajoute une fonction à lancer lors de l'évènement "onreadystatechange"
xmlhttp.onreadystatechange = handleRequest;
/* 
    J'ouvre la requête, en lui donnant les paramètres suivant :
        1. la méthode utilisée en string (ici GET)
        2. l'url auquel lancer la requête.
        3. Si la requête doit être asynchrone
*/
xmlhttp.open("GET", url, true);
// On envoi la requête :
xmlhttp.send();


function handleRequest()
{
    console.log(xmlhttp.readyState, xmlhttp.status);
    if(xmlhttp.readyState === 4 && xmlhttp.status === 200)
    {
        let success, data;
        /* 
            le try{}catch(e){}
            Permet de tenter l'execution du code passé dans "try".
            si une erreur est provoqué elle sera capturé et le "catch"
            sera lancé.
            cela permet d'éviter que notre application plante en cas d'erreur.

            Le finally est optionnel et se lance dans tous les cas une fois le try catch terminé
        */
        try
        {
            console.log(xmlhttp.responseText);
            data = JSON.parse(xmlhttp.responseText);
            console.log(data);
            success = true;
        }
        catch(e)
        {
            console.error(e.message + " Dans -> "+xmlhttp.responseText);
            success = false;
        }
        finally
        {
            if(success)
            {
                document.body.innerHTML = `<h1>${data.squadName}</h1>`;
            }
        }
    }
}

// ? ------------------------- Fetch ----------------------
/* 
    fetch est toujours en asynchrone,
    par défaut, il est en methode "GET"
    Il prendra en premier paramètre, l'url auquel envoyer la requête
    et optionnellement en second, des options.

    On le fera suivre d'un ".then()" qui contiendra une fonction callback à lancer une fois la requête terminé.
*/
fetch(url).then(handleFetch);

function handleFetch(response)
{
    if(response.ok)
    {
        /* 
            L'objet "response" de fetch contient sa propre methode asynchrone pour traiter le json.
            Je ne passerais donc pas par "JSON.parse()" mais par ".json()"
            elle sera suivi elle aussi d'un "then()" ainsi que d'un "catch()" en cas d'erreur
        */
        response.json()
            .then(function(data){
                document.body.innerHTML += `<h2>${data.homeTown}</h2>`;
            })
            .catch(error=>console.error(error));
    }
}