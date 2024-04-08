"use strict";
class Truc {
    /*
        Les accesseurs public, protected et private
        ne sont pas compilé en JS
    */
    prenom = "Maurice";
    nom = "Dupont";
    age = 54;
}
const t = new Truc();
t.prenom;
// Les propriétés protected et private ne sont pas accessible à l'exterieur de la classe.
// t.nom;
// t.age;
class Machin extends Truc {
    constructor() {
        super();
        this.prenom;
        this.nom;
        // La propriété protected est hérité mais pas la private
        // this.age;
    }
    faireUnTruc() {
        /*
            par défaut, this vaut l'objet englobant (ici sa classe)
            Mais si une méthode est crée dans le but d'être utilisé dans un addEventListener, ou d'être bind.
            la valeur de this peut changer.
            Afin de l'indiquer à TS, on peut placer dans les paramètres :
            "this:nouveauType"
            Cela ne compte pas comme un paramètre à donner à la fonction.
        */
        this;
    }
}
class Collection {
    items;
    /*
        Placer un accesseur (public, protected ou private) directement dans les paramètres du constructeur.
        est un raccourci qui signifie :
            - déclare ma propriété dans ma class.
            - reçoit un paramètre dans le constructeur.
            - Donne la valeur de ce paramètre à ma propriété.
    */
    constructor(items) {
        this.items = items;
    }
    addOne(arg) {
        this.items.push(arg);
        return this;
    }
    addMore(arg) {
        this.items.push(...arg);
        return this;
    }
}
/*
    En utilisant un generic sur ma classe.
    Une fois le type défini dans le constructeur.
    Mon objet n'accepte plus que ce type.
    Ici j'ai donné un tableau de chiffre,
    seul des chiffres peuvent être utilisé dans mes méthodes.
*/
const c = new Collection([5, 4, 8, 9]);
c.addOne(42).addMore([9, 76]).addOne(21);
class Triangle {
    c1 = 5;
    c2 = 8;
    c3 = 2;
}
class Rectangle {
    c1 = 12;
    c2 = 20;
}
function getC1(arg) {
    return arg.c1;
}
/*
    Lorsque TS vérifie si le type d'une classe est bon.
    Il ne vérifi pas le nom de la classe.
    Mais si l'objet fourni, contient au moins toute les propriétés de la classe attendu.

    Ici il attend un objet avec les propriétés "c1" et "c2"
    Triangle à au moins ces deux propriétés, il est donc accepté.
*/
getC1(new Rectangle());
getC1(new Triangle());
/*
    Une classe abstraite est une classe qui ne peut pas être instanciée

    Elle sert de modèle à d'autres classes afin d'être héritée.

    Elle peut contenir des propriétés et des méthodes classiques
    Mais aussi des méthodes abstraite.
    Elles sont déclaré, mais pas définie

    Les classes qui en héritent doivent définir elles même comment la méthode fonctionne.
*/
class Polygone {
    sides = {};
    countSide() {
        return Object.keys(this.sides).length;
    }
}
class Carre extends Polygone {
    constructor(c) {
        super();
        this.sides.c1 = c;
        this.sides.c2 = c;
        this.sides.c3 = c;
        this.sides.c4 = c;
    }
    surface() {
        return this.sides.c1 * this.sides.c2;
    }
}
const square = new Carre(5);
console.log(square.surface());
console.log(square.countSide());
