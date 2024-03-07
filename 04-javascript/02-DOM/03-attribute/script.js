"use strict";
const h1 = document.querySelector('#mainTitle');
console.dir(h1);
// ? ---------- l'attribut Style --------------------
/* 
    Sur tous nos éléments HTML, nous pourront retrouver une propriété "style".
    Celle ci contient toute les propriétés CSS existante.
    En modifiant celles ci, cela viendra ajouter du CSS directement sur notre balise.

    !Attention :
        Les propriétés CSS en plusieurs mots (background-color), sont remplacé par une version camelCase (backgroundColor)
*/
h1.style.backgroundColor = "red";
// On n'a accès qu'au CSS directement dans le HTML sur la balise et non dans un fichier CSS
console.log(h1.style.border, h1.style.backgroundColor );
h1.style.fontStyle = "italic";
h1.style.textShadow = "5px 5px rgba(0,0,0,0.3)";
h1.style.fontSize = "5rem";

/* 
    Si on se trompe sur un nom de propriété, il n'y a aucune erreur 
    La propriété est ajouté mais ignoré car il ne la connait pas.
*/
h1.style.couleur = "red";
// De même si on se trompe sur la valeur donnée.
h1.style.color = "rgbaa(255, 255, 255, 0.8)";

// ? ------------------- les classes ---------------------
/* 
    Changer le style peut être pratique mais très verbeux
    On peut aussi choisir de changer une classe, et donc avoir toute les propriétés de cette classe qui s'applique ou non.

    Pour cela deux possibilités,
    soit "className" qui permet de récupérer tout l'attribut class sous forme de string :
*/
console.log(h1.className);
// Change tout l'attribut "class" par une nouvelle string.
h1.className = "banane";
// Supprime toute les classes :
h1.className = "";
// Ajouter une classe sans supprimer les autres :
h1.className += " banane";

/* 
    Soit "classList" qui retourne un objet "DOMTokenList"
    contenant toute les classes sous forme de tableau
    Et des méthodes pour travailler avec :
*/
console.log(h1.classList);

// supprimer une classe :
h1.classList.remove("banane");
// Ajouter une classe :
h1.classList.add("banane");
// Ajoute ou supprime la classe selon si elle est déjà présente ou non.
h1.classList.toggle("banane");
// retourne un boolean indiquant si la classe est présente :
console.log(h1.classList.contains("banane"));

// ? ---------------------- les autres attributs -------------------
/* 
    Pour la plupart des autres attributs,
    il est possible de les appeler directement via leurs noms,
    soit via les méthodes "getAttribute()" et "setAttribute"

    Les deux solutions auront le même effet
*/
console.log(h1.id, h1.getAttribute("id"));
// Pour le modifier il suffit de lui dire qu'il est égale à autre chose
h1.id += "2";

const a = document.querySelector('footer ul li a');
// Avec setAttribute, on indique en premier l'attribut à changer puis en second, la valeur à lui donner.
a.setAttribute("target", "_blank");

/* 
    les data-attributes font exception
    Pour y accèder nous devrons utiliser "dataset"
    suivi du nom du data-attribute
*/
console.log(a.dataset.color);
a.style.backgroundColor = a.dataset.color;
// Pour ajouter un data-attribute, il suffit d'utiliser un nom qui n'existe pas :
a.dataset.bidule = "Je ne sert à rien";