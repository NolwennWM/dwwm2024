"use strict";
const div = document.querySelector('.anime');

document.querySelector(".b1").addEventListener("click", animation1);
document.querySelector(".b2").addEventListener("click", animation2);
document.querySelector(".b3").addEventListener("click", animation3);
document.querySelector(".b4").addEventListener("click", animation4);
document.querySelector(".b5").addEventListener("click", animation5);

function animation1()
{
    /* 
        La methode animate de JS permet des animations plus poussés qu'en CSS.
        Elle prendra deux arguments, le premier étant la liste des keyframes.
        Le second, un objet contenant les options de l'animation.
        Les keyframes peuvent être un tableau d'objet,
            ou un objet contenant des tableaux.
    */
    const keyframes = [
        {left: 0, top: 0},
        {left: "80%", top:"-200px"},
        {left: "20%", top: "500px"}
    ];
    const options = {
        duration: 2000,
        iterations: 3,
        fill: "forwards",
        direction: "alternate"
    };
    // J'utilise la méthode animate sur l'element HTML que je souhaite animer :
    div.animate(keyframes, options);
}
function animation2()
{
    // Version des keyframes avec un objet contenant des tableaux :
    const keyframes = {
        backgroundColor: ["blue", "red", "green"],
        opacity: [1, 0, 0.5]
    };
    div.animate(keyframes, {
        duration: 2000,
        direction: "alternate",
        iterations: 2
    })
}
function animation3()
{
    // On peut sauvegarder l'objet animate dans une variable afin d'avoir accès à certaines méthodes comme "addEventListener"
    const anime = div.animate(
        {transform:["skew(0deg, 0deg)", "skew(360deg, 180deg)", "skew(0deg, 360deg)"]},
        {duration: 1500, direction: "alternate", iterations: 1}
        );
    console.log(anime);

    anime.addEventListener("finish", ()=>{
        document.querySelector(".b4").style.opacity = 1;
    })
}
let a4;
function animation4()
{
    if(!a4)
    {
        a4 = div.animate(
            {borderRadius: ["0", "50%", "5px", "25%"]},
            {duration: 2500, fill: "forwards"}
        );
    }
    else
    {
        // On peut remettre à 0 notre animation avec ".cancel()"
        a4.cancel();
        a4 = undefined;
    }
}
// La méthode animate n'est qu'un raccourci pour l'utilisation des objets suivants :
let keyframes = new KeyframeEffect(div,[
    {transform: "translate(0,0)"},
    {transform: "translate(100%, 50%)"}
],{duration: 2500, fill:"forwards"});

let a5 = new Animation(keyframes, document.timeline);

async function animation5()
{
    const b5 = document.querySelector('.b5');
    // La propriété ".playState" représente l'état dans lequel est l'animation (en cours, terminé...)
    switch(a5.playState)
    {
        case "idle":
            a5.play();
            b5.textContent = "Pause";
            // La propriété "finished" contient une promesse se résolvant quand l'animation est terminée.
            await a5.finished;
            b5.textContent = "Reverse";
            break;
        case "running":
            a5.pause();
            b5.textContent = "Continue";
            break;
        case "paused":
            a5.play();
            b5.textContent = "Pause";
            break;
        case "finished":
            a5.reverse();
            b5.textContent = "Pause";
            await a5.finished;
            b5.textContent = "Start";
            break;
    }
}