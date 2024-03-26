"use strict";
/* 
    le mot clef "this" représente l'objet dans lequel il se trouve.
    Par défaut il représente l'objet "window"
*/
console.log(this);
console.log(this === window);

function test()
{
    /* 
        Dans une fonction il sera soit undefined (si use strict est utilisé)
        soit encore une fois l'objet fenêtre.
    */
    console.log(this);
}
test();
/* 
    Dans un "addEventListener" this représente l'objet sur lequel l'évènement est placé.
*/
document.body.addEventListener("click", test);
/* 
    sur un évènement au clique, this peut être utile pour toujours cibler l'élément voulu.
    event.target représentant l'élément cliqué qui peut changer si notre cible à des enfants 
    (ici il change si on clique sur le span)
*/
document.body.addEventListener("click", function(e)
{
    console.log(e.target, this);
});
/* 
    ! ATTENTION
    Si une fonction fléché est utilisée
    this ne représente plus la cible de l'évènement
    mais l'objet englobant (ici "window")
*/
document.body.addEventListener("click", ()=>
{
    console.log(this);
});

document.body.click();
/* 
    ".bind()" permet de créer une copie d'une fonction avec une valeur pour "this" qui diffère.
    ici mon "test2" à comme valeur pour "this" l'objet donné en argument de bind.
*/
let test2 = test.bind({text: "Salut tout le monde !", age: 54});
test();
test2();

let article = document.createElement("article");

document.body.addEventListener("click", test.bind(article));
document.body.click();