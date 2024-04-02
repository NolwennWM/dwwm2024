"use strict";
/* 
    $("") sert à la fois pour "querySelectorAll" et "createElement"
    $("div") selectionne toute les divs.
    $("<div>") Crée une nouvelle div.
*/
const btnSlide = $("#slide");
console.log(btnSlide);
// l'équivalent de addEventListener :
btnSlide.on("click", slideTitle);

function slideTitle()
{
    /* 
        Certains effets classiques des animations CSS, telle que "fade", "slide", ou "hide" sont implémentés de base dans jquery.

        On pourra leur donner une durée et optionnellement, une fonction à lancer une fois l'animation terminé 
    */
    $("h1").slideToggle(1000, function(){
        console.log("Toggle terminé !");
        /* 
            Pour accèder aux propriétés CSS avec Jquery, on utilisera la méthode ".css()";
            Elle prendra 1 seul argument si on veut récupérer la valeur, 
            Deux arguments si on veut la modifier :
        */
        const color = btnSlide.css("background-color") === "rgb(255, 0, 0)"? "green":"red";
        console.log(color);
        btnSlide.css("background-color", color);
    })
}

$("#fade").on("click", fadeSpan);

function fadeSpan()
{
    // La plupart des méthodes Jquery peuvent s'appliquer directement à de multiples éléments HTML sans faire de boucle
    $("h1 span").fadeToggle();
}
// Jquery peut ajouter plusieurs évènements d'un seul coup :
$("h1 span").on("mouseenter mouseleave", function(e)
{
    // Jquery remplace le "this" de l'évènement par "$(this)"
    if(e.type === "mouseenter") $(this).css("font-size", "4rem");
    else $(this).css("font-size", "");
})

/* 
    $(function) permet d'attendre que le DOM ai fini de chargé avant de lancer le code.
*/
$(function(){
    $("#load").on("click", function()
    {
        $("ol").hide(200);
        /* 
            $.ajax("") est le fetch de jQuery
            On le fera suivre des méthodes ".done()", ".fail()" et ".always()"
            qui sont l'équivalent de then, catch et finally
        */
        $.ajax("liste.json")
            .done(data=>{
                // Jquery comprend directement que les données sont en JSON et les traduits automatiquement en objet Javascript
                console.log(data);
                data.forEach(d=>{
                    /* 
                        const li = document.createElement("li");
                        li.textContent = d;
                        document.querySelector("ol").append(li);
                        !Attention, la méthode appendTo de JQuery est inversé par rapport au append de JS :
                            parent.append(enfant)
                            enfant.appendTo(parent)
                    */
                    $("<li>").text(d).appendTo($("ol"));
                }) // fin forEach
                $("ol").show(500);
            }) // fin done
            .fail(err=>console.error(err))
            .always(()=>console.log("Requête Terminé !"));
    })// fin on click
    $("#anime").on("click", function()
    {
        $(this).css("position", "absolute");
        /* 
            La fonction animate de jQuery diffère de celle de Javascript
            elle se contenante de prendre en premier argument, un objet contenant les valeurs à modifier.
            et en second, la durée de l'animation.
            * On notera on peut lui donner des valeurs à augmenter ou diminuer
        */
        $(this).animate({
            width: "50vw",
            height: "5rem",
            top: "+=50px",
            left: "-=50px"
        }, 500);
    })  // fin on click
});