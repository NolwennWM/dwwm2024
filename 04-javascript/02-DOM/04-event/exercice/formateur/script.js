/*
    Exercice 1 :

    Faire que lors de la selection d'une couleur dans la div 2
    le texte du bouton change de couleur, 
    et lors de l'appuie sur le bouton, 
    le background de la div change de couleur.
*/
const d2 = document.querySelector('.div2');
const i2 = document.querySelector('.div2 input');
const b2 = document.querySelector('.div2 button');

i2.addEventListener("input", textColor);
b2.addEventListener("click", bgColor);

function textColor(e){
    b2.style.color = e.target.value;
}
function bgColor(){
    d2.style.backgroundColor = i2.value;
}
/* 
    Exercie 2 :

    Lors du clique sur le bouton de la div 3,
    faire apparaître une modale (soit déjà créé en html/ soit que l'on crée en JS)
    Cette modale doit contenir un élément permettant de la faire disparaître.
*/
// constante pour toute les réponse.
const b3 = document.querySelector('.div3 button');
// reponse 1 : Créer la modale
function modal(){
    if(document.querySelector(".m1")){
        return;
    }
    const div = document.createElement("div"),
    p = document.createElement("p"),
    h = document.createElement("h2"),
    btnA = document.createElement("button"),
    btnB = document.createElement("button");

    div.classList.add("modal", "m1");
    h.textContent = "Santé !";
    p.textContent = "Mangez 5 fruits et légume par jour, les produits laitiers sont nos amis pour la vie, ne mangez ni trop gras, ni trop sucré, ni trop salé, l'abus d'alcool est dangereux pour la santé.";

    btnA.textContent = "Mangeons sain";
    btnB.textContent = "Le gras c'est la vie";

    div.append(h, p, btnA, btnB);
    document.body.appendChild(div);
    btnB.addEventListener("click", ()=>div.remove());
}
// b3.addEventListener("click", modal);
// constante pour réponse 2 et 3
const m2 = document.querySelector('.m2');
const m2btn = m2.querySelector("button:last-of-type")
//réponse 2: Utiliser une modale présente en HTML (class)

function modal2(){
    m2.classList.toggle("hidden");
}
// b3.addEventListener("click", modal2);
// m2btn.addEventListener("click", modal2);
// réponse 3: Utiliser une modale présente en HTML (style)

b3.addEventListener("click", ()=>m2.style.display = "grid");
m2btn.addEventListener("click", ()=>m2.style.display = "none");
/* 
    Exercice 3 :

    Faites que tous nos li dans la nav double de taille lorsque l'on clique dessus.
    puis retournent à leurs tailles d'origine si on clique de nouveau dessus.
*/
const liste = document.querySelectorAll('nav li');
function double(e){
    let li = e.target;
    if(li.style.transform == "scale(2)"){
        li.style.transform = "scale(1)";
    }
    else{
        li.style.transform = "scale(2)";
    }
}
liste.forEach(l=>l.addEventListener("click", double));

/* 
    Exercie 4 :
    
    Utilise les évènements "mouseenter" et "mousemove" pour 
    faire que lorsque l'on passe sur le span du footer, il commence à suivre la souris
    et cela jusqu'à ce que l'on clique, il retournera alors à sa position d'origine.
*/
const sp = document.querySelector('.endOfFile');

sp.addEventListener("mouseenter", followOn);
document.body.addEventListener("click", followoff);

function followOn(e){
    sp.style.position = "absolute"
    document.body.addEventListener("mousemove", follow)
}
function follow(e){
    sp.style.top = e.clientY+"px";
    sp.style.left = e.clientX+"px";
}
function followoff(){
    sp.style.position = "initial";
    document.body.removeEventListener("mousemove", follow);
}

// bonus possible : text-reveal