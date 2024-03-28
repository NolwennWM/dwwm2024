"use strict";
// J'importe mes objets.
import P from "./Paint-v2.js";
import G from "./JustePrix.js";
import S from "./Slider-v2.js";
// je crée mes objets
const paint = P.create();
const justePrix = G.create();
const slider = S.create(["/cours/ressources/images/paysage/sea.jpg", "/cours/ressources/images/paysage/lava.jpg"], true);
// Exemple de fin
// const slider2 = S.create(["/ressources/images/sea.jpg", "/ressources/images/lava.jpg"]);

const select = document.querySelector('select#appli');
const appli = document.querySelector('div.appli');
// J'ajoute mon évènement et j'appelle une première fois ma fonction
select.addEventListener("input", selectAppli)
selectAppli.bind(select)();

/**
 * Affiche le projet selectionné dans le bouton select.
 */
function selectAppli()
{
    appli.firstChild?.remove();
    switch(this.value)
    {
        case "slider":
            appli.append(slider);
            // document.body.append(slider2);
            break;
        case "justePrix":
            appli.append(justePrix);
            break;
        case "paint":
            appli.append(paint);
            P.resize();
            break;
    }
}
/* 
    On remarquera que si on tente d'ajouter deux carousels
    ils rentreront en conflit.
    C'est le même objet que l'on utilise, il nous en faudrait
    un nouveau totalement à part pour éviter cela.
    C'est ce que va nous permettre le cours suivant.
*/