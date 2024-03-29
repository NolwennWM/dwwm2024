"use strict";
import C from "./Slider.js";

C.style();
const carousel = new C(["/ressources/images/paysage/sea.jpg", "/ressources/images/paysage/lava.jpg"]);
document.body.append(carousel.slider);
carousel.init();
const carousel2 = new C(["/ressources/images/paysage/ville.jpg", "/ressources/images/paysage/space.jpg"]);
document.body.append(carousel2.slider);
carousel2.init();