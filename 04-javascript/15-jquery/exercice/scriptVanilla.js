"use strict";

let idInterval;

document.addEventListener("DOMContentLoaded", function () {
    // Applique un style de fond gris aux éléments li impairs de la liste à puces du slider
    document.querySelectorAll('#slider ul li:nth-child(odd)').forEach(function (element) 
    {
        element.style.background = "#aaa";
    });

    // Ajoute un écouteur d'événement pour le changement de l'état de la case à cocher
    document.getElementById('checkbox').addEventListener('change', function () 
    {
        if (this.checked) { // Si la case est cochée
            idInterval = setInterval(moveRight, 1500); // Démarre l'animation du slider vers la droite
        } else { // Si la case n'est pas cochée
            clearInterval(idInterval); // Arrête l'animation du slider
        }
    });

    // Calcule les dimensions du slider et les applique aux éléments correspondants
    let slideCount = document.querySelectorAll('#slider ul li').length; // Nombre total de diapositives dans le slider
    let slideWidth = document.querySelector('#slider ul li').offsetWidth; // Largeur d'une diapositive
    let slideHeight = document.querySelector('#slider ul li').offsetHeight; // Hauteur d'une diapositive
    let sliderUlWidth = slideCount * slideWidth; // Largeur totale du conteneur du slider

    // Applique les dimensions au conteneur du slider et à la liste à puces
    document.getElementById('slider').style.width = slideWidth + "px";
    document.getElementById('slider').style.height = slideHeight + "px";
    document.querySelector('#slider ul').style.width = sliderUlWidth + "px";
    document.querySelector('#slider ul').style.marginLeft = -slideWidth + "px";
    moveLeft(false)

    // Insère une copie du dernier élément li au début de la liste pour créer une boucle d'animation infinie
    let lastSlide = document.querySelector('#slider ul li:last-child');
    lastSlide.parentNode.insertBefore(lastSlide.cloneNode(true), lastSlide.nextSibling);
    lastSlide.parentNode.removeChild(lastSlide);

    // Fonction pour déplacer le slider vers la gauche (sens décroissant)
    function moveLeft(anime = true) 
    {
        let sliderUl = document.querySelector('#slider ul');
        sliderUl.style.left = slideWidth + "px"; // Déplace la liste à puces vers la droite pour afficher la diapositive précédente
        if(anime)sliderUl.style.transition = "left 0.2s ease-in-out"; // Ajoute une transition pour l'animation

        // Après la transition, déplace la dernière diapositive au début de la liste
        setTimeout(function () 
        {
            sliderUl.insertBefore(sliderUl.lastElementChild, sliderUl.firstElementChild);
            sliderUl.style.left = ""; // Réinitialise la position de la liste à puces
            sliderUl.style.transition = ""; // Réinitialise la transition
        }, 200); // Attend 200 millisecondes pour que la transition se termine
    };

    // Fonction pour déplacer le slider vers la droite (sens croissant)
    function moveRight() 
    {
        let sliderUl = document.querySelector('#slider ul');
        sliderUl.style.left = -slideWidth + "px"; // Déplace la liste à puces vers la gauche pour afficher la diapositive suivante
        sliderUl.style.transition = "left 0.2s ease-in-out"; // Ajoute une transition pour l'animation

        // Après la transition, déplace la première diapositive à la fin de la liste
        setTimeout(function () 
        {
            sliderUl.appendChild(sliderUl.firstElementChild);
            sliderUl.style.left = ""; // Réinitialise la position de la liste à puces
            sliderUl.style.transition = ""; // Réinitialise la transition
        }, 200); // Attend 200 millisecondes pour que la transition se termine
    };

    // Ajoute des écouteurs d'événements aux boutons de contrôle précédent et suivant pour déclencher les fonctions de déplacement
    document.querySelector('a.control_prev').addEventListener('click', moveLeft);
    document.querySelector('a.control_next').addEventListener('click', moveRight);
});