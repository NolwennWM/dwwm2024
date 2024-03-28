"use strict";
import Human from "./Human.js";
/* 
    L'héritage permet de transférer toute les propriétés et méthodes (non "private")
    d'une classe à une autre.

    Cela permet d'avoir un parent commun à plusieurs classes plutôt que de copier coller les propriétés communes à ces classes.

    Pour utiliser l'héritage, on fera suivre le nom de la classe, par le mot clef "extends" puis du nom du parent.
*/
export default class Dev extends Human
{
    /**
     * Crée un nouveau développeur
     * @param {string} prenom prenom du développeur
     * @param {string} nom nom du développeur
     * @param {number|string} age age du développeur
     * @param {string|Array} tech technologies connues du développeur
     */
    constructor(prenom, nom, age, tech)
    {
        /* 
            Lorsque l'on fait un constructor dans une classe qui hérite.
            Il nous faut appeler le constructeur parent avant toute autre chose.
            Pour cela on utilise la fonction "super()"
        */
        super(prenom, nom, age);
        this.techniques = tech;
    }
    set techniques(t)
    {
        if(Array.isArray(t))
        {
            this.tech = t;
        }
        else
        {
            this.tech = [t];
        }
    }
    /* 
        Bien que la classe hérite de toute les propriétés et méthodes "public" du parent.
        On pourrait voulori qu'une méthode fonctionne différement avec cette classe.
        
        Pour cela il suffit de redéclarer la méthode, elle viendra remplacer celle du parent
    */
    salutation()
    {
        console.log(`Bonjour, je suis ${this.fullname} et j'ai ${this.getAge}. Je maîtrise ${this.tech.join(", ")}.`);
    }
}
