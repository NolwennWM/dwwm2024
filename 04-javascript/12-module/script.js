"use strict";
/* 
    Ecmascript permet l'export et l'import de fonctions et objets (entre autre choses).
    Cela permet de diviser nos projets en plusieurs fichiers réutilisable.
    De plus cela nous évite d'avoir plusieurs balises script dans notre HTML que l'on doit placer dans le bon ordre.

    Pour utiliser cet export import, notre fichier principal doit être lié au HTML avec l'attribut :
        type="module"
    
    ? --------------- Export --------------------
    pour importer du code, il faut avant tout l'exporter.
    Dans le fichier que l'on souhaite exporter.

    On va ajouter devant les éléments à exporter, les mots clefs 
        export ou export default

    On ne peut "export default" qu'un seul élément par fichier.

    ? ---------------- Import ---------------------
    Il y a deux solutions pour importer des éléments.
    La première ne peut se trouver qu'au niveau le plus haut du code.
    C'est à dire, hors de toute fonction, condition ...

    Pour exporter les éléments qui n'ont pas le mot clef "default".
    On va utiliser le mot clef "import" suivi d'accolade dans lesquels on trouvera le nom des éléments à importer séparés d'une virgule.
    Enfin on met le mot clef "from" suivi du chemin vers le fichier
        * import {salut, coucou} from "./salutation.js";

    Lors de l'import, le code contenu est executé (ici le console.log se lance)
    Si pour une raison ou une autre, un même fichier est importé plusieurs fois, le code ne se relancera pas.

    Si un "export default" est présent, Pour le selectionner, on placera avant les accolades un nom (peu importe lequel) et il sera utilisé pour contenir l'élément exporté par défaut:
        * import bidule, { salut, coucou } from "./salutation.js";

    Dans le cas de nombreux import, on peut se retrouver avec des éléments portant le même nom. 
    Pour éviter  un conflit, on peut renommer nos imports :
        * import bidule, { salut as s1, coucou } from "./salutation.js";

    Si on souhaite tout importer d'un coup, on pourra créer un objet contenant tous les exports :
        * import * as salutations from "./salutation.js";
*/
import bidule, { salut as s1, coucou } from "./salutation.js";
import * as salutations from "./salutation.js";

s1();
coucou("Maurice");
bidule();

console.log(salutations);
salutations.coucou("Pierre");
salutations.salut();
salutations.default();
/* 
    Pour faire un import sans être au top level du script.
    Il ne faudrat pas utiliser le mot clef "import"
    mais la fonction "import()";

    Celle ci retournera une promesse, et cette promesse contiendra un objet avec tout ce qui a été exporté.
*/
window.addEventListener("click", hello);

async function hello()
{
    const bonsoir = await import("./salutation.js");
    console.log(bonsoir);

    bonsoir.salut();
    bonsoir.coucou("Charles");
    bonsoir.default();
}
