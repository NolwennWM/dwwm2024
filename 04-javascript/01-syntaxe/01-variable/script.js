"use strict";
// Commentaire sur une seule ligne.
/* 
    Commentaire sur plusieurs lignes.
    "use strict" permet d'indiquer au navigateur de ne pas corriger les petites erreurs qu'il pourrait comprendre. (ceci est optionnel)

    Une instruction (une ligne de code) en JS peut optionnellement se terminer par ";" 
    Si il n'est pas présent, c'est le saut à la ligne qui mettra fin à l'instruction.
*/
// ? ----------- Déclaration des variables ------------
/* 
    Il existe trois mots clef pour déclarer une variable.
    Les noms de variables peuvent contenir n'importe quel lettre, chiffre et autres characters, mais ne peuvent pas commencer par un chiffre.

    let est le mot clef le plus conseillé pour déclarer une variable.
*/
let banane;
// Pour utiliser une variable, il suffit d'écrire son nom.
console.log("banane :", banane);
// var crée des variables avec une portée plus grande (voir plus bas pour les portées)
var tomate;
/*
    const permet de déclarer des constantes, des variables qui ne peuvent pas changer.
    Elles doivent être définie au moment de leur déclaration.
    Pour donner une valeur à une variable, on utilise le symbole "="
*/
const cerise = 5;
// ! Erreur car on essaye de changer une constante
// cerise = 3;

// On peut déclarer plusieurs variables d'un seul coup, en les séparant d'une virgule :
let a, b, c;
// ! On ne peut pas redéclarer une variable déjà existante :
// let a;

// On peut définir nos variables lors de leur déclaration :
var d, e = 4, f = 5;

// ? ------------- La portée des variables -----------------
let gLet = 1;
var gVar = 1;
// des accolades seules représentent un block séparé du reste du code.
{
    let hLet = 2;
    var hVar = 2;
    // Dans un bloc, les variables déclarés hors de celui, sont accessible.
    console.log(gLet, gVar, hLet, hVar);
}
/* 
    Hors de mon bloc, seule les variables déclarées avec "var" sont accessible.
    Les variables déclarées avec "let" ne sont accessible qu'à leur niveau ou dans leurs descendant.
    "const" suis les même règles que "let"
*/
console.log(gLet, gVar, /* hLet, */ hVar);
{
    // On peut redéclarer des variables dans un block différent.
    let gLet = 5;
    var gVar = 5;
    console.log("Dans le block :", gLet, gVar);
}
/* 
    le "var" redéclaré dans le block, vient remplacer la variable précédente.
    le "let" lui est considéré comme une autre variable.
    On récupère donc notre ancien "let" hors du block
*/
console.log("Hors du block :", gLet, gVar);

// ? ------------------ Types des variables ---------------
// Si une instruction attend une suite (avec une "," ou une parenthèse non fermé), alors le saut à la ligne, ne met pas fin à celle ci.
let num = 5,
    str = "Coucou",
    bol = true,
    arr = [],
    obj = {},
    und;

// le mot clef "typeof" permet de récupérer le type d'une variable.
console.log("num", typeof num);
console.log("str", typeof str);
console.log("bol", typeof bol);
console.log("arr", typeof arr);
console.log("obj", typeof obj);
console.log("und", typeof und);

/* 
    Il existe 5 types en JS
    Les tableaux (array) et les objets (object), bien qu'ayant un fonctionnement différent,
    Sont tous les deux de type "object"
    Certains langages différencies les nombres à virgule et entier, mais pas JS

    Javascript est un langage dit "non typé", c'est à dire que lors de la déclaration des variables, nous n'avons pas à indiquer leur type
    (ce qui est le cas dans les langages typés)
    Et que nos variables peuvent changer de type à tout moment :
*/
bol = 42;
console.log("bol MAJ :", typeof bol);

// ?  --------------- chaînes de caractères ---------------
/* 
    Pour définir un string (chaîne de caractère) on pourra utiliser au choix "", '' ou ``;
    "" et '' n'ont aucune différence dans leur utilisation.
*/
let s1 = "L'apostrophe ne pose aucun problème ici";
let s2 = 'L\'apostrophe pose problème ici';
s1 = 'Le grand ordinateur a dit "42"';
s2 = "Le grand ordinateur a dit \"42\"";
/* 
    L'utilisation de "" ou '' peut être utile si on a besoin de l'autre dans notre string.
    Mais si on n'a pas le choix, on peut venir échapper un caractère.
    Cela signifie indiquer au code de ne pas prendre en compte ce caractère.
    Pour cela on le fait précéder de "\"
*/
s1 = "Karl";
/* 
    La concaténation est le fait de fusionner au moins deux string.
    En JS celle ci se fait avec le caractère "+"
*/
s2 = "Bonjour " + s1 + " Comment vas-tu?"
console.log(s2);
/* 
    On peut obtenir le même résultat avec l'interpolation
    C'est le fait d'inserer du code dans un string.
    Cela ne peut être fait en JS qu'avec les ``
    On placera le code à l'interieur de ${}
*/
let s3 = `Bonjour ${s1} Comment vas-tu?`;
console.log(s3);
// ne fonctionne pas :
console.log('Bonjour ${s1} Comment vas-tu?'); 

/* 
    Avec "" ou '', impossible d'écrire un string sur plusieurs lignes.
    Mais c'est possible avec ``
*/
/* s1 = "Je ne peux pas
sauter de ligne"; */
s3 = `Je peux très bien
    sauter des lignes`;
console.log(s3);
/* 
    Bonus : 
    On peut ajouter du CSS sur un console.log
    pour cela il faut placer "%c" au début du string
    puis mettre le CSS en second paramètre :
*/
console.log("%cATTENTION !!!!", "color:yellow;background-color:red;font-size:3rem;");

// ? ----------- les nombres -----------------
/* 
    Javascript perd en précision sur les grands nombres.
    Il est possible d'espacer les nombres avec "_" pour plus de lisibilité.
*/
console.log(9_999_999_999_999_999);
/* 
    Il peut avoir des résultats étranges avec certains nombres à virgule
*/
console.log(0.2 + 0.1);
// Les opérations standards disponible sont :
console.log(
    5+5,
    5-5,
    5*5,
    5/5,
    5%5,
    5**5
);
// % (modulo) retourne le reste de la division
// ** représente la puissance
console.log(
    5 + "5",
    5 - "5",
    5 + "Banane",
    5 - "Banane"
);
/* 
    Si on tente d'additionner un chiffre et un string, cela devient une concaténation.
    Si on tente de les soustraire, si le string est un chiffre, pas de problème, sinon il nous retourne "NaN" (Not a Number)
    De quel type est NaN ?
*/
console.log(typeof NaN);
// Il est possible de vérifier si une variable ou une opération retourne un NaN avec la fonction "isNaN()"
console.log(isNaN(5-"Chaussette"), isNaN(5-"1"));
// On peut représenter la plus grande valeur numérique en JS par :
console.log(Infinity, -Infinity);

/* 
    Les opérateurs d'affectation permettent de donner une valeur à une variable.
    On a vu "="
    Mais il en existe d'autres :
*/
let n = 0;
n += 5; // équivaut à n = n+5;
n-= 2;
n *= 3;
n/= 4;
n %= 3;
n**= 2;
console.log(n);
/* 
    Il arrive souvent en développement, que l'on veuille ajouter ou retirer 1 à une variable.
    C'est ce qu'on appelle incrémenter ou décrémenter.
    Cela peut se faire avec les caractères suivant :
*/
n++; // équivalent de n += 1;
n--; // équivalent de n -= 1;
++n;
--n;
/* 
    si le signe est placé après, le nombre d'origine est donné puis l'opération effectué.
    Si il est placé avant, l'opération est effectué puis le nouveau nombre donné
*/
console.log("n++", n++, n);
console.log("n--", n--, n);
console.log("++n", ++n, n);
console.log("--n", --n, n);

n= 17;
/* 
    Javascript utilise des fonctions et des méthodes.
    La différence étant leur placement.
    Une fonction s'écrit directement comme "isNan()"
    Une méthode s'écrit à la suite d'un "." comme "console.log()"

    la méthode ".toString()" permet de transformer un nombre en string
*/
console.log(n, n.toString());
// On peut optionnellement ajouter un paramètre pour changer la base mathématique :
console.log(n, n.toString(2));

// Pour l'effet inverse on utilisera la fonction parseInt()
let s = "10011101";
console.log(s, parseInt(s));
// On peut optionnellement ajouter un second paramètre pour changer la base mathématique :
console.log(s, parseInt(s,2));

// ? ----------------- Tableaux / Array ------------
/* 
    Un tableau est une liste de valeur.
    Pour la déclarer il y a deux solutions :
    La récente :
*/
let a1 = [5, "truc", true];
// Et l'ancienne :
let a2 = new Array(5, "truc", true);
// Peu importe celle choisi, le résultat est le même :
console.log(a1, a2);
/* 
    Pour afficher un élément précis du tableau.
    Je dois faire suivre sa variable de []
    dans lesquels j'indique l'index de l'élément à afficher.
    ! Les index d'un tableau commence à 0
*/
console.log(a1[1]);
// On peut récupérer la taille d'un tableau avec la propriété ".length"
console.log(a1.length);
// Pour obtenir le dernier élément d'un tableau dont la taille n'est pas connu :
console.log(a1[a1.length-1]);
/* 
    Depuis EcmaScript 2022, la méthode .at() permet aussi de récupérer un élément d'un tableau. 
    Mais celle ci accepte les nombres négatif pour choisir depuis la fin du tableau : 
*/
console.log(a1.at(-1));
// A noter que ces selections fonctionnent aussi sur les string :
console.log("Salut"[2], "Salut".at(-1));

// On peut ajouter un élément à la fin de notre tableau avec la méthode ".push()"
a1.push("Bidule");
console.log(a1);
// On peut retirer le dernier élément du tableau avec :
a1.pop();
console.log(a1);
// On peut ajouter un élément au début du tableau avec :
a1.unshift(42);
console.log(a1);
// On peut supprimer un élément au début du tableau avec :
a1.shift();
console.log(a1);

/* 
    Pour ajouter / retirer des éléments dans le tableau.
    On utilisera ".splice()"
    Celle ci prendra au moins 2 arguments
        Le premier l'index où se positionner.
        Le second combien d'élément à supprimer.
    Si on souhaite en ajouter, on les placeras à la suite
*/
a1.splice(1,1);
console.log(a1);
a1.splice(1, 0, "chaussette");

let a3 = [4, 1, 42, 8, 14];
// La méthode .sort() permet de trier par ordre alphabetique... uniquement:
a3.sort();
console.log(a3);
/* 
    On peut améliorer la fonction sort, mais on verra cela dans le cours sur les fonctions.

    On peut modifier ou ajouter un élément au tableau en indiquant directement l'index :
*/
a1[1] = "Pizza";
console.log(a1);
// Si on saute des index, il créera des cases vides
a1[8] = "Poivre";
console.log(a1);
// en indiquant sa longueur comme index, on obtiendra toujours la dernière case
a1[a1.length] = "Sel";
console.log(a1);

let a4 = a2;
console.log(a4, a2);
/* 
    si je souhaite faire une copie d'un tableau
    simplement lui indiquer qu'une variable est égale au précédent tableau ne fonctionne pas.
    Cela car ce qui est stocké dans la variable n'est pas le tableau mais l'adresse dans la mémoire du tableau.
    On donne donc à notre nouvelle variable cette même adresse
    En modifier un modifiera donc l'autre.
*/
a4.push("Super Tableau !");
console.log(a4, a2);
/* 
    Pour éviter cela, on utilisera plutôt le "spread operator"
    Celui ci permet de décomper un tableau en differents elements séparés d'une virgule.
    par exemple :
*/
console.log(a2, ...a2);
// En décomposant mon tableau dans un nouveau tableau, j'obtient une copie:
let a5 = [...a2];
a5.push("Super Clone !");
console.log(a2, a5);
// On peut aussi se servir du spread operator pour fusionner un tableau dans un autre :
let a6 = ["pizza", ...a5, "pomme", "banane"];
console.log(a6);
// Sans le spread operator, on se retrouve avec un tableau dans un tableau :
let a7 = ["pizza", a5, "pomme", "banane"];
console.log(a7);
// Pour accèder à une valeur d'un tableau multidimensionnel, il suffit de faire suivre les index :
console.log(a7[1][3], a7[1].length);
// On peut avoir autant de tableau multidimensionnel que l'on souhaite :
let a8 = [[[[[["Coucou"]]]]]]
console.log(a8, a8[0][0][0][0][0][0]);

// Pour échanger la place de deux éléments d'un tableau, deux solutions :
let tmp = a7[0];
a7[0] = a7[3];
a7[3] = tmp;
// ou alors :
[a7[0], a7[3]] = [a7[3], a7[0]];

// ? -------------- Objets -------------------
/* 
    Les objets ressemblent à des tableaux, mais sont déclaré avec {}
    Au lieu d'être indexé numériquement,
    On utilisera des noms de propriété :
*/
let o1 = {nom: "Dupont", age: 45, loisir: ["bowling", "mahjong"]};
// Pour accèder à une propriété, on indique le nom de la variable suivi d'un "." et du nom de la propriété
console.log(o1.nom, o1.age, o1.loisir);
// On peut aussi y accèder comme un tableau:
console.log(o1["nom"], o1["age"], o1["loisir"]);

let o2 = [{vegetal:{legume:{haricot:["vert"]}}}];
console.log(o2[0].vegetal.legume.haricot[0]);

// ? -------------- Booleans -----------------
// Les booleans n'acceptent que deux valeur "true" ou "false";
let b1 = true, b2 = false;

// On peut les faire apparaître via des conditions :
console.log("1 < 2 :", 1<2);
console.log("1 > 2 :", 1>2);
console.log("1 <= 2 :", 1<=2);
console.log("1 >= 2 :", 1>=2);

// Pour comparer une égalité, il faut au moins 2 "="
console.log("1 == '1' :", 1 == '1');
// Avec 3, le type sera aussi comparé
console.log("1 === '1' :", 1 === '1');


console.log("1 != '1' :", 1 != '1');
console.log("1 !== '1' :", 1 !== '1');

// Un point d'exclamation devant un boolean va inverser le résultat
console.log("b1 :", b1, "b2 :", b2);
console.log("!b1 :", !b1, "!b2 :", !b2);

// On va pouvoir vérifier plusieurs cas à la fois avec "&&" et "||"
// Avec "&&" il faut que les deux conditions soient vrai pour obtenir "true"
console.log(
    true && true,
    true && false,
    false && true,
    false && false
);
// Avec "||" il suffit qu'une des conditions soient vrai pour obtenir "true"
console.log(
    true || true,
    true || false,
    false || true,
    false || false
);

// Le principe de "court-circuit" permet de ne pas vérifier une instruction selon le résultat de la première.
let nb = 0;
// avec "&&" si la première instruction est fausse, la seconde ne sera pas vérifié
console.log(true && ++nb, nb);
console.log(false && ++nb, nb);
// avec "||" si la première est vrai, la seconde n'est pas vérifié.
console.log(false || ++nb, nb);
console.log(true || ++nb, nb);




