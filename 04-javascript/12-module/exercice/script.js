import * as slider from "./slider.js";

const images = ["../../../assets/images/paysage/lava.jpg","../../../assets/images/paysage/montagne.jpg","../../../assets/images/paysage/phare.jpg","../../../assets/images/paysage/space.jpg"];

const sliderElement = slider.createSlider(images);
document.body.prepend(sliderElement);

slider.Ss();
console.log(images);