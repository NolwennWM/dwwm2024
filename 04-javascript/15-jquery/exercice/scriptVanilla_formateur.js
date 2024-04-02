"use strict";
let idInterval, slider, sliderUl, sliderLi;
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('#slider ul li:nth-child(odd)').forEach(li => {
        li.style.background = "#aaa";
    });
    document.querySelector('#checkbox').addEventListener("change", function () {
        if (this.checked) {
            idInterval = setInterval(moveRight, 1500);
        } else {
            clearInterval(idInterval)
        }

    });
    slider = document.querySelector('#slider');
    sliderUl = document.querySelector('#slider ul');
    sliderLi = document.querySelectorAll('#slider ul li');
    let slideCount = sliderLi.length;
    let slideWidth = sliderLi[0].offsetWidth;
    let slideHeight = sliderLi[0].offsetHeight;
    let sliderUlWidth = slideCount * slideWidth;

    slider.style.width = slideWidth + "px";
    slider.style.height = slideHeight + "px";

    sliderUl.style.width = sliderUlWidth + "px";
    sliderUl.style.marginLeft = -slideWidth + "px";

    sliderUl.prepend(document.querySelector('#slider ul li:last-child'));

    function moveLeft() {
        let anime = sliderUl.animate({
            left: [0, slideWidth + "px"]
        }, {
            duration: 200,
            fill: "forwards"
        });
        anime.onfinish = () => {
            anime.cancel()
            sliderUl.prepend(document.querySelector('#slider ul li:last-child'))
        }
    };

    function moveRight() {
        let anime = sliderUl.animate({
            left: [0, -slideWidth + "px"]
        }, {
            duration: 200,
            fill: "forwards"
        });
        anime.onfinish = () => {
            anime.cancel()
            sliderUl.append(document.querySelector('#slider ul li:first-child'))
        }
    };
    document.querySelector('a.control_prev').addEventListener("click", moveLeft);
    document.querySelector('a.control_next').addEventListener("click", moveRight);
});