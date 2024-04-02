"use strict";
/* 
    La balise template est par défaut invisible.
    Peu importe ce qui est mit dedans.

    Son but est d'accueillir des éléments HTML qui vont servir à être récupéré par JS,
    afin d'être cloné et réutilisé à divers endroit.

    On commencera par selectionner notre template.
    Puis avec la propriété "content", on récupère son contenu sous le forme d'un "documentFragment".

    Enfin nous clonerons ce fragment via la méthode ".cloneNode(true)"
    dont le boolean permet de cloner le contenu de balise et pas juste la balise elle même.

    Il nous reste qu'à insérer le clone dans le HTML
*/
// Je récupère le template :
const blogTemplate = document.querySelector('template#blog');
// Je récupère le contenu du template :
const blogArticle = blogTemplate.content;
console.log(blogArticle);

// Je selectionne les éléments que je souhaite modifier :
const blogTitle = blogArticle.querySelector('h2');
const blogText = blogArticle.querySelector('p');
const blogSource = blogArticle.querySelector('a');

// Je récupère le contenu de mon fichier json.
getBlog();
async function getBlog()
{
    const response = await fetch("blog.json");
    if(!response.ok) return;
    const articles = await response.json();
    articles.forEach(a=>{
        // Je modifie mon template :
        blogTitle.textContent = a.title;
        blogText.textContent = a.content;
        blogSource.textContent = a.source;
        blogSource.href = a.source;
        // je clone mon template :
        const clone = blogArticle.cloneNode(true);
        // J'insert le clone dans mon html :
        document.body.append(clone);
    });
}

/* 
    Si les templates sont utilisable seuls,
    les slots eux accompagnent forcément le shadowDOM.

    On va donc tester cela sur un webComponent.

    En insérant des balises "slot" avec des attributs "name".
    Puis en liant ce template au shadowDOM d'un custom Element.

    Lorsque je vais appeler mon custom Element, si je place des balises HTML ayant l'attribut "slot" avec une valeur correspondant au "name" d'un slot, 
    celle ci viendra remplacer le "slot".

    Ainsi il est possible d'insérer des éléments variables à nos templates.
*/
import SuperCard from "./SuperCard.js";