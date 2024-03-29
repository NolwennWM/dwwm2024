import SuperBalise from "./SuperBalise.js";
import SuperDiv from "./SuperDiv.js";
/* 
    Les customs elements permettent de créer nos propres éléments HTML.

    Il existe deux types de custom elements :
        - les éléments personnalisés autonomes qui héritent de "HTMLElement"
        - les éléments personalisées intégrés qui heritent d'un élément HTML particuleir (div, span, li...)

    Pour les créer, nous allons devoir définir une classe.
    Puis hors de celle ci, appeler la méthode suivante :
        * customElements.define();

    Cette méthode prendra en premier argument, un string représentant le nom que l'on souhaite donner à notre custom element.
        ! IMPORTANT : On demande de choisir des noms comportant un tiret "-"

    En second argument elle prendra la classe qui la définie.
    Dans le cas d'un élément personalisé intégré, on donnera un troisième argument, pour indiquer le nom de la balise dont elle hérite :
        * {extends: "li"}

    Une fois la méthode appelé, pour utiliser nos balises :
        - autonome : <nom-balise></nom-balise>
        - intégré : <baliseParent is="nom-balise"></baliseParent>

    Il est possible d'ajouter des "cycle de vie" à nos éléments HTML.
    Les cycles de vie, sont des méthodes prédéfinie qui se déclenchent automatiquement à certains moments précis:
        - "connectedCallback()" se déclenche quand l'élément HTML est ajouté à la page.
        - "disconnectedCallback()" se déclenche quand l'élément HTML est retiré de la page.
        - "adoptedCallback()" se déclenche quand l'élément est déplacé d'un document à un autre (iframe par exemple)
        - "attributeCallback()" se déclenche lorsque l'attribut ciblé est modifié.
            Il prendra 3 paramètres :
                - le premier recevra le nom de l'attribut modifié.
                - le second la valeur de l'attribut avant modification.
                - le troisième, la valeur après modification.
        Pour que cela fonctionne, on devra accompagner ce cycle de vie, d'un "getter static" appelé "observedAttributes()" qui retourne un tableau contenant les attributs à observer.
*/