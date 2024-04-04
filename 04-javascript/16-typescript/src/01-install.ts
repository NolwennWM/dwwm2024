"use strict";
/* 
    --------- Installation -------------
    * npm install typescript --save-dev

    Compiler un fichier ts en js :
    * npx tsc pathToFile.ts

    Compiler vers un autre dossier :
    * npx tsc pathToFile.ts --outDir folderName

    Pour éviter de retaper cela à chaque fois,
    Nous pouvons créer à la racine du projet, un fichier 
    * tsconfig.json

    qui contiendra un objet avec les propriétés suivantes :
    {
        "compilerOptions": {
            "outDir": "dist"
        },
        "files":[
            "src/01-install.ts"
        ]
    }
    Une fois cela fait, nous pouvons simplement taper :
    * npx tsc

    Comme avec d'autres bibliothèques comme "scss", nous pouvons demander à typescript de surveiller chaque sauvegarde de nos fichiers :
    * npx tsc --watch
*/
const btn = document.querySelector("#compte");
let i = 0;
btn?.addEventListener("click", ()=>{
    i++;
    /* 
        Là où JS transforme automatiquement des nombres en texte
        TS provoque une erreur.
    */
    // btn.textContent = i;
    btn.textContent = i.toString();
});
/* 
    Par défaut typescript compile pour du JS agé, afin d'être compatible avec les vieux navigateurs.
    Si on veut un code plus moderne, on pourra changer dans le fichier de configuration l'option :
    * "target": "ES2022"

    On peut lui interdire de compiler si il y a une erreur :
    * "noEmitOnError": true

    Si on veut être capable de gérer n'importe quelle erreur qui pourrait arriver, 
    On peut demander à TS d'être encore plus strict !
    * "strict": true
*/
// btn?.style.backgroundColor = "orange";