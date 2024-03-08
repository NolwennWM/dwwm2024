/*
    Exercice 1 :

    Faire que lors de la selection d'une couleur dans la div 2
    le texte du bouton change de couleur, 
    et lors de l'appuie sur le bouton, 
    le background de la div change de couleur.
*/
const bt2 = document.querySelector(".div2 input");
const bt3 = document.querySelector(".div2 button");

bt2.addEventListener("change", function(e)
{
    console.log(bt2);
    bt3.style.backgroundColor = bt2.value;
})
const div2 = document.querySelector(".div2");
bt3.addEventListener("click", function(e){
    div2.style.backgroundColor = bt2.value;
})
/* 
    Exercie 2 :

    Lors du clique sur le bouton de la div 3,
    faire apparaître une modale (soit déjà créé en html/ soit que l'on crée en JS)
    Cette modale doit contenir un élément permettant de la faire disparaître.
*/
const fenetre = document.querySelector("aside");
const btnMove = document.querySelector(".div3 button");
const btnFermer = document.querySelector(".fenetre .fermer");

btnMove.onclick = ()=>{
    fenetre.style.left = "40%";
    fenetre.style.transition = "1s";
    btnFermer.onclick = ()=>{
        fenetre.style.left = "100vw";
    }
}
/* 
    Exercice 3 :

    Faites que tous nos li dans la nav double de taille lorsque l'on clique dessus.
    puis retournent à leurs tailles d'origine si on clique de nouveau dessus.
*/
const menuT = document.querySelector("ul");
menuT.onclick = function(e)
{
    if(!(e.target instanceof HTMLLIElement)) return;
    if(e.target.style.fontSize === "")
    {
        e.target.style.fontSize = "2rem";
    }
    else
    {
        e.target.style.fontSize = ""
    }
}
/* 
    Exercie 4 :
    
    Utilise les évènements "mouseenter" et "mousemove" pour 
    faire que lorsque l'on passe sur le span du footer, il commence à suivre la souris
    et cela jusqu'à ce que l'on clique, il retournera alors à sa position d'origine.
*/
const textfooter = document.querySelector("span");

textfooter.onmouseenter = function()
{
    textfooter.style.position = "absolute";
    document.body.onmousemove = function(a)
    {
        textfooter.style.left = a.clientX + "px";
        textfooter.style.top = a.clientY + "px";
    }
    document.body.onclick = function()
    {
        textfooter.style.position = "";
        document.body.onmousemove = "";
    }
}