"use strict";
/* 
    Pour déclarer une fonction, on utilisera le mot clef "function"
    On le fera suivre, du nom que l'on souhaite donner à la fonction.
    puis de parenthèses contenant ou non, des paramètres.
    Et enfin des accolades contenant le corps de la fonction.

    Une fonction déclaré, mais qui n'est jamais appelé, n'executera aucun code.
    Pour appeler une fonction, on écrit son nom suivi de parenthèses.

    On peut appeler une fonction, avant ou après sa déclaration.
    De ce fait, une bonne pratique est de placer toute les fonctions ensemble (soit au début, soit à la fin du code)
*/
salut();
function salut()
{
    console.log("Salut le monde !");
}
salut();

/* 
    Il existe d'autres façons de déclarer une fonction.
    Ces autres façons ne peuvent être utilisé qu'après leurs déclaration.

    On peut créer une fonction "anonyme" en la rangeant dans une variable, un tableau ou un objet
*/
// salut2(); Impossible d'appeler avant la déclaration
const salut2 = function()
{
    console.log("Salut les gens !");
}
salut2();
/* 
    On peut aussi déclarer des fonctions fléchés
    Des fonctions anonyme dont le mot clef "function" a disparu
*/
const salut3 = ()=>{
    console.log("Coucou le peuple !");
}
salut3();
// ? ----------------- paramètres (ou arguments) ---------------
/* 
    Lorsque l'on place des paramètres dans la déclaration de fonction
    Celle ci attend des arguments lors de son appel
    Ces arguments sont transmits à la fonction.
*/
function bonsoir(nom)
{
    console.log("Bonsoir " + nom);
}
bonsoir("Romain");
/* 
    Si il manque des arguments, les paramètres seront "undefined"
    Si il y en a trop, ils seront juste ignoré.
*/
bonsoir();
/* 
    On peut avoir autant de paramètre que souhaité, simplement en les séparents d'une virgule.
    Le premier argument sera transmit au premier paramètre et ainsi de suite.
*/
function bonneNuit(nom1, nom2)
{
    console.log(`%cBonne nuit ${nom1} et ${nom2}`, "color:yellow;background: blue;");
}
bonneNuit("Patrick", "Raphael");
/* 
    Il est possible de donner une valeur par défaut à nos paramètres.
    Dans ce cas, si l'argument n'est pas fourni.
    au lieu d'être undefined, il prendra sa valeur par défaut.
*/
function goodBye(nom1, nom2 = "les autres")
{
    console.log(`Good bye ${nom1} et ${nom2}`);
}
goodBye("Kevin");
goodBye("Kevin", "Alan");

console.log(1,2, 3,4,5,6,7,8,9);
/* 
    Si on souhaite une infinité  d'argument possible,
    On peut utiliser le rest operator "..."
    Tous les arguments supplémentaire iront dans un tableau 
*/
function goodMorning(...noms)
{
    // console.log(noms);
    console.log(`Good Morning ${noms.toString()}`);
    console.log(`Good Morning ${noms.join(" et ")}`);
}
goodMorning("Pierre", "Paul", "Jacques");