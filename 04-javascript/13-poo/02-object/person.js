"use strict";
/* 
    La programmation orienté objet consiste à développer notre logique et nos fonctions à l'interieur d'objets.

    La plupart des langages demandent à passer par des classes et des constructeurs pour créer des objets. 
    Mais en JS, on peut créer nos objets manuellement.

    On verra donc les classes plus tard.
*/
const Person = {
    name: {
        prenom : "Maurice",
        nom : "Dupont"
    },
    age:54,
    /* 
        Les setters servent à paramètrer une propriété d'un objet en la filtrant par quelconques fonctions.

        Le setter se déclare tel une foncton, mais avec le mot clef "set"
        par contre son utilisation se fera telle une propriété.
            * Person.setAge = 30; ok
            ! Person.setAge(30);  error
    */
    set setAge(a)
    {
        // Dans un objet, this fait référence à l'objet en question.
        this.age = parseInt(a);
    },
    set nom(n)
    {
        this.name.nom = n.toUpperCase();
    },
    set prenom(p)
    {
        this.name.prenom = p[0].toUpperCase()+p.slice(1).toLowerCase();
    },
    /* 
        Comme pour le setter, nous avons le getter qui permet de récupérer une information après l'avoir filtré.
        précédé du mot clef "get" celui ci aura forcément un "return"
        là aussi il s'utilise comme une propriété
    */
    get fullname()
    {
        return `${this.name.prenom} ${this.name.nom}`;
    },
    /* 
        Nos objets peuvent aussi contenir des fonctions.
        pour les déclarer, aucun besoin de mot clef.
        ! ATTENTION !
        En POO, on ne parle pas de variable ou de fonctions d'un objet
        Mais on parle de propriété ou de méthode d'un objet.
    */
    salutation()
    {
        console.log(`Bonjour, je suis ${this.fullname} et j'ai ${this.age} ans.`);
    },
    anniversaire()
    {
        this.age++;
        this.salutation();
    }
};
export default Person;