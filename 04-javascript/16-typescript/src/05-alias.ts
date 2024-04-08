// ------------------ ALIAS ----------------
type Fruit = {nom: string, couleur: string};
/* 
    J'ai déclaré un type "Fruit" avec le mot clef "type"
    Puis je peux l'utiliser pour typer mes variables 
*/
let f: Fruit = {nom: "Pomme", couleur: "Rouge"};
let aF: Fruit[] = [f, {nom:"Banane", couleur: "Verte"}];

/* 
    Je peux utiliser un type pour définir un autre type :
*/
type Age = number|string;
type Person = {nom: string, age: Age};

let p: Person = {nom: "Maurice", age: 45};
/* 
    Ici j'indique que le type "Name" doit être du même type que la propriété "nom" du type Fruit.
*/
type Name = Fruit["nom"];
let n: Name = "George";

/* 
    Ici notre type "Full" n'accepte grâce à "keyof"
    que des strings qui valent les noms des propriétés de "Person"
    "age" ou "nom"
*/
type Full = keyof Person;
let fp: Full = "age";
/* 
    "typeof" permet de créer un type qui correspond à un objet précédement créé.
*/
let objet = {vieux: true, prenom: "Maurice", age: 78};
type Item = typeof objet;
let o2: Item = {vieux: false, prenom: "Pierre", age: 24};

// --------------------- GENERICS -----------------------------
function useless(arg:any): any
{
    return arg;
}
let machine = useless("Salut");
/* 
    TS ne regarde pas le fonctionnement de votre fonction.
    Si on lui indique une valeur de retour "any"
    Alors la variable à laquelle on attribut notre fonction sera de type "any"

    Mais avec les generics, on peut indiquer à TS
    que le type reçu en argument sera le même que celui de la valeur de retour.
*/
function useful<Type1>(arg:Type1): Type1
{
    return arg;
}
let machine2 = useful("Bonjour");
let machine3 = useful(42);
/* 
    Ici on indique que ma fonction va utiliser un type particulier.
    Que l'argument est un tableau de ce type
    Mais que la valeur de retour est juste ce type.
*/
function lastOf<TypeArr>(arr:TypeArr[]):TypeArr
{
    return arr[arr.length-1];
}
let last1 = lastOf([24, 45, 12]);
let last2 = lastOf(["a", "b", "c"]);

/* 
    Ici j'indique que le type reçu en argument, 
    doit obligatoirement possèder la propriété length.
*/
function logSize<Type2 extends {length:number}>(arg: Type2): Type2
{
    console.log(arg.length);
    return arg;    
}
let size1 = logSize([45]);
let size2 = logSize("Test");
// let size3 = logSize(54);
logSize({nom: "Charlie", length: 145})