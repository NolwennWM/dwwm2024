"use strict";
import Human from "./Human.js";

const h = new Human("Maurice", "Dupont", 54);

console.log(h, Human);

// La propriété static est accessible sur la classe, mais pas sur l'objet :
console.log(Human.categorie, h.categorie);
Human.description();
// h.description();

// J'ai accès à ma propriétée public, mais pas à la privée
console.log(h.vivant/* , h.#name */);

// Si je souhaite un nouvel humain, il me suffit d'instancier encore ma classe :
const h2 = new Human("Pierre", "Fontaine", 39);

h.salutation();
h2.salutation();

import Dev from "./Dev.js";

const d = new Dev("Bruno", "Dubois", 19, "Javascript");
d.salutation();
d.anniversaire();

// On peut vérifier si un objet est une instance d'une classe avec :
console.log(d instanceof Dev);
// Un objet instancié depuis une classe qui hérite, est aussi une instance de la classe hérité :
console.log(d instanceof Human);