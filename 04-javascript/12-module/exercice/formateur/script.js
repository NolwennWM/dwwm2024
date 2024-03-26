"use strict";
const images = ["../../ressources/images/paysage/lava.jpg","../../ressources/images/paysage/montagne.jpg","../../ressources/images/paysage/phare.jpg","../../ressources/images/paysage/ville.jpg"];

window.addEventListener("click", addSlider)
async function addSlider(){
    const sliderJS = await import("./slider.js")
    const slider = sliderJS.create(images);
    document.body.append(slider);
    sliderJS.default();
    window.removeEventListener("click", addSlider);
}