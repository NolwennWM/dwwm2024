"use strict";
/**
 * Affiche un message de salutation
 */
export default function bonjour()
{
    console.log("Bonjour les gens !");
}
/**
 * Affiche un message de salutation
 */
export function salut() 
{
    console.log("Salut les gens !");
}
/**
 * Affiche un message de salutation adressé à quelqu'un
 * @param {string} name nom de la personne
 */
export function coucou(name) 
{
    parler(name, "Coucou tout le monde !")
}
/**
 * Affiche un message dans la console précédé d'un nom
 * @param {string} nom nom d'une personne
 * @param {string} text message de la personne
 */
function parler(nom, text)
{
    console.log(`${nom} : ${text}`);
}

console.log("Salutation Importé !");