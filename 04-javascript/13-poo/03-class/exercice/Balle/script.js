"use strict";
import B from "./Balle.js";
const canvas = document.querySelector('canvas');
const ctx = canvas.getContext("2d");
const balles = [];
function resize(){
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
resize();
window.addEventListener("resize", resize);
canvas.addEventListener("pointerdown", ()=>balles.push(new B(canvas)))
function cercle(){
    ctx.clearRect(0,0, canvas.width, canvas.height);
    balles.forEach(balle=>balle.draw())
    requestAnimationFrame(cercle)
}
cercle()