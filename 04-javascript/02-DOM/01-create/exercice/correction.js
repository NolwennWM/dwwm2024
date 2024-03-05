"use strict";
console.log(m);
const d = document.createElement("div");
d.innerHTML = "<h1>Santé !</h1><p>J'ai la flemme d'écrire</p><button>tchin tchin</button><button>Le gras c'est la vie</button>";
if(document.body)
{
    document.body.append(d);
}