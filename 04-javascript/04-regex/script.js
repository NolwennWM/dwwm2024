"use strict";
/* 
    REGEX ou Expression Régulière,
    Permet de vérifier la présence dans un string de certains caractères.

    Une REGEX commence et se termine par "/" (ou un flag, voir plus bas)
*/
const r1 = /ou/;
/* 
    "regex.test(string)" retourne un boolean indiquant si la regex a été trouvé dans le string.

    Plusieurs fonctions JS peuvent utiliser les regex.

    r1 recherche la présence de "ou"
*/
console.log(r1, r1.test("Bonjour"), r1.test("Salut"));

// r2 recherche la présence d'un "o" ou d'un "u"
const r2 = /[ou]/;
console.log(r2, r2.test("Bonjour"), r2.test("Salut"));

// r3 recherche si le string commence par "ou"
const r3 = /^ou/;
console.log(r3, r3.test("Bonjour"), r3.test("outre"));

// r4 recherche si le string fini par "ou"
const r4 = /ou$/;
console.log(r4, r4.test("Bonjour"), r4.test("mou"));

// r5 recherche la présence de "ou" ou "oi"
const r5 = /ou|oi/;
console.log(r5, r5.test("Bonjour"), r5.test("Bonsoir"));

// r6 recherche la présence d'au moins une lettre entre "a" et "z"
const r6 = /[a-z]/;
console.log(r6, r6.test("Bonjour"), r6.test("0987654321"));

// r7  recherche la présence d'un caractère qui n'est pas entre "a" et "z"
const r7 = /[^a-z]/;
console.log(r7, r7.test("Bonjour"), r7.test("0987654321"));

// r8 recherche la présence de "o" et optionnellement "u"
const r8 = /ou?/;
console.log(r8, r8.test("Pizza"), r8.test("Bonsoir"));

// r9 recherche la présence de "ou" au moins une fois (et plus)
const r9 = /(ou)+/;
console.log(r9, r9.test("Bonjour"), r9.test("Bonsoir"));

// r10 recherche la présence de "ou" autant de fois que voulu (même 0)
const r10 = /(ou)*/;
console.log(r10, r10.test("Bonjour"), r10.test("Bonsoir"));

// r11 recherche la présence de "cou" 2 fois.
const r11 = /(cou){2}/;
console.log(r11, r11.test("coup"), r11.test("coucou les gens"));

// r12 recherche la présence de "cou" entre 1 et 2 fois
const r12 = /(cou){1,2}/;
console.log(r12, r12.test("coup"), r12.test("coucou les gens"));

// r13 recherche la présence de "cou" au moins 2 fois ou plus
const r13 = /(cou){2,}/;
console.log(r13, r13.test("coup"), r13.test("coucou les gens"));

// r14 recherche la présence de "^" (\ permet d'échaper un caracter special pour lui retirer son rôle dans la regex)
const r14 = /\^/;
console.log(r14, r14.test("coup"), r14.test("Ceci est une regex /^a/"));
// r15 recherche la présence d'espace. (\ devant un caracter sans rôle peut lui en donner un \s pour espace, \d pour nombre...)
const r15 = /\s/;
console.log(r15, r15.test("coup"), r15.test("coucou les gens"));

// r16 recherche la présence de n'importe quel caractere.
const r16 = /./;
console.log(r16, r16.test("coup"), r16.test("coucou les gens"));

// r17 recherche la présence de "ou" ou "oi" puis après quelque caractères, la présence du même résultat que la première parenthèse (si "ou" a été trouvé, il veut un nouveau "ou")
const r17 = /(ou|oi).*\1/;
console.log(r17, r17.test("Bonjour à tous"), r17.test("Bonsoir à tous"));

// ? ------------------------ Flags -------------------------
/* 
    Les flags sont des caractères ajouté à la fin de la regex (après le /)
    Ils viennent lui donner de nouvelles capacités.

    On va les tester avec la méthode "string.match(regex)" qui retourne un tableau contenant les résultats de la regex.
*/
const phrase = "J'aime la pizza, les cannelés et les okonomiyakis";
console.log(phrase.match(/pizza/));

// par défaut, une regex s'arrête au premier résultat trouvé.
console.log(phrase.match(/les/));
// le flag "g" permet une recherche global (recherchant dans toute la string)
console.log(phrase.match(/les/g));

// Par défaut, les regex sont sensible à la casse (majuscule / minuscule)
const phrase2 = "Vive les regex et vive javascript !";
console.log(phrase2.match(/vive/g));
// le flag i rend la regex insensible à la casse.
console.log(phrase2.match(/vive/gi));

const phrase3 = 
`1er : Maurice
2ème : Paul
3ème : Charlie`;
// par défaut, un saut à la ligne n'est pas considéré comme un nouvel élément dans lequel chercher.
console.log(phrase3.match(/^\d/g));
// avec le flag "m" chaque saut à la ligne représente une nouvelle recherche à effectuer.
console.log(phrase3.match(/^\d/gm));

// ?---------------- autres détails ------------

// un "e" n'est pas un "é", les accents sont à lister séparément :
console.log(/^[a-z]+$/i.test("élodie"),/^[a-zéèàçùêâ]+$/i.test("élodie"));



