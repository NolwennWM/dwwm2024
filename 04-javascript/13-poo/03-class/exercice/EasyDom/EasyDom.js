"use script";
/**
 * Faire une classe EasyDom qui prendra 3 méthodes et pas de constructeur.
 * 1. La méthode select prendra un argument. (par exemple "balise")
 *      Elle devra faire un querySelectorAll sur cet argument
 *      puis elle vérifiera combien d'élément elle a trouvé, 
 *      si il y en a qu'un elle retournera cet élément sinon elle retournera le tableau.
 * 2. la méthode event qui prendra 3 arguments (par exemple "balise", "evenement", "fonction").
 *      si argument 1 est une instance de HTMLElement. elle fera un addEventlistener dessus en donnant 
 *          les arguments 2 et 3 en paramètre de celui ci.
 *      Sinon il fera un forEach sur l'argument 1 pour ajouter sur tous les éléments un addEventListener
 *          commme précédement.
 * 3. La méthode tag prendra deux arguments dont le second sera par défaut un objet vide {}.
 * (par exemple "balise" et "options")
 *      elle commencera par créer un élément HTML en utilisant le premier argument.
 *      puis pour chaque option si la clef est "innerHTML" ou "textContent" alors elle ajoutera 
 *      les valeurs correspondante à la balise précédement créé
 *      sinon elle ajoutera la clef en attribut avec sa valeur (setAttribute);
 *      puis retournera le nouvel élément.
 */
export default class EasyDom{
    tag(balise, options = {}){
        let tag = document.createElement(balise);
        for(let o in options){
            // console.log(o);
            if(o == "innerHTML" || o == "textContent"){
                tag[o] = options[o];
                continue;
            }
            tag.setAttribute(o,options[o]);
        }
        return tag;
    }
    select(balise, parent = document){
        const elements = parent.querySelectorAll(balise);
        if(elements.length === 1){
            return elements[0];
        }
        return elements;
    }
    event(balise, evenement, fonction){
        if(balise instanceof HTMLElement){
            balise.addEventListener(evenement, fonction);
            return;
        }
        balise.forEach(b=>{
            b.addEventListener(evenement, fonction);
        })
    }
}