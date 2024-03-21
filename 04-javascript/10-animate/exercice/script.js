"use strict";

const p1 = document.querySelector('.p1');
const p2 = document.querySelector('.p2');
const div = document.querySelector('.div2');

function animation()
{
    p1.textContent = "Développeur";
    p2.textContent = "Web";
    const keyframes = [
        {transform: "translate(100%, 0%)"},
        {transform: "translate(0%, 0%)"}
    ];
    const keyframes2 = [
        {transform: "translate(-100%, 0%)"},
        {transform: "translate(0%, 0%)"}
    ];
    const keyframes3 = [
        {opacity: "0"}
    ];
    const options = {
        duration: 2000
    }
    const options2 = {
        duration: 2000,
        delay: 2000
    }
    p1.animate(keyframes, options);
    p2.animate(keyframes2, options);
    p1.animate(keyframes3, options2);
    p2.animate(keyframes3, options2);
    div.animate(keyframes3, options2);
    setTimeout(()=>{
        p1.textContent = "Maurice";
        p2.textContent = "Dupont";
        p1.animate(keyframes, options);
        p2.animate(keyframes2, options);
    }, 4000);
    setTimeout(()=>{
        p1.animate(keyframes3, options2);
        p2.animate(keyframes3, options2);
        div.animate(keyframes3, options2);
        animation();
    }, 6000)
}
animation();