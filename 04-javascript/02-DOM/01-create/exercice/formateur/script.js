/*  
!créer une modale en JS qui va venir se placer devant 
!le reste de la page et centré dans celle ci.
!Celle modale devra contenir un titre, un paragraphe et deux boutons
!cela en étant un minimum stylisé en css.*/
const div = document.createElement("div"),
p = document.createElement("p"),
h2 = document.createElement("h2"),
b1 = document.createElement("button"),
b2 = document.createElement("button");

h2.textContent = "Santé !";
p.textContent = "Mangez 5 fruits et légume par jour, les produits laitiers sont nos amis pour la vie, ne mangez ni trop gras, ni trop sucré, ni trop salé, l'abus d'alcool est dangereux pour la santé.";

b1.textContent = "tchin tchin !";
b2.textContent = "Le gras c'est la vie";

div.append(h2, p, b1, b2);
document.body.appendChild(div);