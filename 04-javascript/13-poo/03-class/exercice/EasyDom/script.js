"use strict";
import E from "./EasyDom.js";
const s = new E(); 

const div = s.tag("div", {class: "truc bidule machin", id: "chaussette", src: "img.jpg", html: "test"});
console.log(div);
const span = s.select("span");
console.log(span);
s.event(span, "click", (e)=>{console.log(e);});
s.event(div, "click", (e)=>{console.log(e);});
div.click();