"use strict";
const dark = document.querySelector('#darkTheme');
dark.addEventListener("input", changeTheme);

function changeTheme()
{
    // Solution 1 : jouer avec la classe du body 
    document.body.classList.toggle("dark", dark.checked);
    localStorage.setItem("theme", dark.checked?"dark":"");
    // Solution 2 : Jouer avec les variables CSS
    // if(dark.checked)
    // {
    //     document.documentElement.style.setProperty("--fond", "#333");
    //     document.documentElement.style.setProperty("--text", "antiquewhite");
    //     /* 
    //         Pour sauvegarder des données dans le navigateur, 
    //         on utilisera "localStorage" ou "sessionStorage"
    //         Le sessionStorage est supprimé quand on quitte le navigateur.

    //         Pour sauvegarder, on utilise la méthode ".setItem(clef, valeur)"
    //         En premier argument on donnera une clef qui servira à retrouver la donnée,
    //         En second la valeur à sauvegarder
    //     */
    //     localStorage.setItem("theme", "dark");
    // }
    // else
    // {
    //     document.documentElement.style.setProperty("--fond", "antiquewhite");
    //     document.documentElement.style.setProperty("--text", "#333");
    //     /* 
    //         Pour supprimer une donnée sauvegardé en session ou local storage:
    //         ".removeItem(clef)"
    //         En donnant en argument, la clef à supprimer
    //     */
    //     localStorage.removeItem("theme");
    // }
}
/* 
    Pour récupérer une donnée sauvegardé, j'utiliserais :
    ".getItem(clef)"
    avec en argument, la clef à récupérer 
*/
// console.log(localStorage.getItem("theme") === "dark");
dark.checked = localStorage.getItem("theme") === "dark";
changeTheme();
/* 
    Si on souhaite supprimer toute les clefs :
    localStorage.clear();
*/