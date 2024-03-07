// ------------EXO 1 ---------------
// Déplacer la modale dans le body.

const div = document.querySelector("div");
const body = document.querySelector('body');
// document.body.appendChild(div);
body.appendChild(div);

// ----------- EXO 2 ---------------
// modifier le texte des 3 li du footer, si possible avec une boucle.
// const test = document.querySelector('footer li');
for (let i = 0; i < lis.length; i++) 
{
    lis[i].textContent = "Changé";
}

// ------------ EXO 3 --------------
// Remplacer le texte des paragraphes pair.

// Solution 1 :
const paragraphes = document.querySelectorAll("main p");

paragraphes.forEach((paragraphes,index)=>{
    if(index % 2 !== 0)
    {
        paragraphes.textContent = "Nouveau texte";
    }
});
// Solution 2 :
const paragraphes2 = document.querySelectorAll('main p:nth-child(even)');
console.log(paragraphes2);
// refaire une boucle 