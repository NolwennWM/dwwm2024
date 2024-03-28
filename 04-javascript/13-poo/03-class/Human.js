"use strict";

/* 
    Une classe est un plan de construction pour un objet.

    Certaines classes sont déjà intégrées à JS :
        "Date", "FormData"...
    Mais on peut évidement créer les notres.
        Pour cela on utilisera le mot clef "class" suivi du nom de la classe puis d'accolades :
            * class MaSuperCLass{}
    
    Quelques convention de développeur :
        - Une classe par fichier,
        - Le nom de la classe commence par une majuscule,
        - Le nom du fichier est le même que celui de la classe
    
    Lorsqu'on voudra créer un objet à partir d'une classe (instancier),
    On appellera le nom de la classe précédé du mot clef "new"
        * const monSuperObjet = new MaSuperClass();
*/
export default class Human
{
    /* 
        En Javascript nous allons trouver 3 types de propriétés :

        - La propriété public, dans une classe, pas besoin de virgule pour séparer les propriétés, ni de mot clef (let, var...)
        - La propriété privée, elle prend un "#" devant son nom
            Elle a la particularité de n'être accessible que dans sa classe.
        - La propriété static, elle est précédé du mot clef "static"
            Elle n'est accessible que sur la classe, et non sur l'objet
        
        Ces mots clefs s'appliquent aussi aux méthodes.
    */
    vivant = true;
    #name = {};
    #age;
    static categorie = "Mammifère";
    /**
     * Crée un nouvel humain
     * @param {string} prenom prenom de l'humain
     * @param {string} nom nom de l'humain
     * @param {number|string} age age de l'humain
     */
    constructor(prenom, nom, age)
    {
        /* 
            La fonction "constructor" est appelé directement à chaque fois que l'on instancie une classe.
            Les arguments donnés à la classe, sont transmis au constructor.
        */
        console.log(prenom, nom, age);
        // On retrouve les getters et les setters
        this.prenom = prenom;
        this.nom = nom;
        this.#setAge = age;

        /* 
            Les propriétés privées doivent être déclaré avant d'être utilisées.
            Mais on peut déclarer de nouvelles propriétés directement dans une méthode
        */
        this.createdAt = new Date();
        // this.#truc = "test";
    }
    set #setAge(a)
    {
        this.#age = parseInt(a);
    }
    set nom(n)
    {
        this.#name.nom = n.toUpperCase();
    }
    set prenom(p)
    {
        this.#name.prenom = p[0].toUpperCase()+p.slice(1).toLowerCase();
    }
    get fullname()
    {
        return `${this.#name.prenom} ${this.#name.nom}`;
    }
    get getAge()
    {
        return this.#age + " ans";
    }
    /*  
        Les méthodes :
        Les méthodes peuvent aussi être public, private ou static
    */
    static description()
    {
        console.log(`Un humain est un ${this.categorie}, a généralement une tête, un buste, deux bras et deux jambes.`);
    }
    salutation()
    {
        console.log(`Bonjour, je suis ${this.fullname} et j'ai ${this.getAge}`);
    }
    anniversaire()
    {
        this.#age++;
        this.salutation();
    }
}