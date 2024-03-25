"use strict";

let painting = false, 
// bonus uniquement.
color = "black", size = 10,
undoList = [], lastAction = [], redoList = [];
// fin bonus
const canvas = document.querySelector('canvas'); 
const ctx = canvas.getContext("2d");
function resize(){
    let snapshot = ctx.getImageData(0,0, canvas.width, canvas.height)
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    ctx.putImageData(snapshot, 0, 0)
    setContext();
}
resize();
window.addEventListener("resize", resize);
function setContext()
{
    ctx.lineWidth = size;
    ctx.strokeStyle = color;
}
/* cette première fonction est appelé quand on commence à dessiner */
function startPosition(e){
    painting = true;
    // pour faire des points au clique
    draw(e);
}
/* Cette seconde fonction est appelé quand on termine de dessiner */
function finishedPosition(){
    painting = false;
    ctx.beginPath();
    undoList.push(lastAction);
    lastAction = [];
}
/* cette fonction fera apparaître le dessin */
function draw(e){
    // Si on n'est pas en train de dessiner, on arrête la fonction.
    if(!painting) return;
    ctx.lineCap = "round";
    let mouse = getMousePos(e);
    /* On dessine là où se trouve la souris. */
    ctx.lineTo(mouse.x, mouse.y);
    ctx.stroke();
    // on augmente un peu la fluidité avec ceci: (optionnelle)
    ctx.beginPath();
    ctx.moveTo(mouse.x, mouse.y);
    lastAction.push({
        x: mouse.x,
        y: mouse.y,
        color: color,
        size: size
    })
}
function getMousePos(evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: evt.clientX - rect.left,
        y: evt.clientY - rect.top
    };
}
function redraw(tab){
    tab.forEach(action =>{
        ctx.beginPath();
        action.forEach(move=>{
            ctx.strokeStyle = move.color;
            ctx.lineWidth = move.size;
            ctx.lineTo(move.x, move.y);
            ctx.stroke();
            ctx.beginPath();
            ctx.moveTo(move.x, move.y);
        })
    })
    ctx.beginPath();
}
function keyboard(e){
    e.preventDefault();
    // Selon la touche pressé je lance différente fonctions.
    switch(e.key){
        case "s":
            save();
            break;
        case "l":
            load();
            break;
        case "c":
            chooseColor();
            break;
        case "z":
            undo();
            break;
        case "y":
            redo();
            break;
        case "+":
            size++;
            console.log(size);
            break;
        case "-":
            size = size<=1?1:--size;
            console.log(size);
            break;
    }
    /*
        paramètre le contexte une fois que les autres actions l'ont modifié
        (par exemple les modifications apportés par le undo/redo)
    */
    setContext();
}
function load(){
    // je crée un nouvel element input
    let input = document.createElement("input");
    // je lui donne le type file
    input.setAttribute("type", "file");
    // je le clique
    input.click();
    // Quand je rentre un fichier.
    input.oninput = function(e){
        // Je crée un lecteur de fichier.
        let reader = new FileReader();
        // quand je charge un fichier dans mon lecteur
        reader.onload = function(event){
            //je crée une nouvelle image.
            let img = new Image();
            // quand mon image est chargé:
            img.onload = function(){
                // je vide mon canvas
                ctx.clearRect(0,0,canvas.width, canvas.height);
                //J'ajoute ma nouvelle image
                ctx.drawImage(img, 0,0);
            }
            /* J'ajoute à la source de mon image ce que me retourne
            mon lecteur */
            img.src = event.target.result;
        }
        // Je donne à mon lecteur, le fichier selectionné.
        reader.readAsDataURL(e.target.files[0]);
    }
}
function save(){
    /* On change les données du canvas en donnée png sous forme de
    string */
    let png = canvas.toDataURL("image/png");
    /* On vient remplacer son type mime par un autre plus apte
    au transfère de donnée. */
    png.replace("image/png", "application/octet-stream");
    // Je crée un lien
    let link = document.createElement("a");
    // Je viens lui ajouter l'attribut download avec le nom du fichier.
    link.setAttribute("download", "SauvegardeCanvas.png");
    // On lui ajoute son href avec mon image en valeur.
    link.setAttribute("href", png);
    // et on le clique
    link.click();
}
function chooseColor(){
    // Je crée un nouvel element input
    let input = document.createElement("input");
    // je lui donne le type color
    input.setAttribute("type", "color");
    // et je clique dessus
    input.click();
    // Lorsque je rentre une couleur dans mon input
    input.oninput = function(e){
        // je donne sa valeur à ma variable color.
        color = e.target.value;
        setContext();   
    }
}
function undo(){
    if(!undoList.length)return;
    let redoAction = undoList.pop();
    redoList.push(redoAction);
    ctx.clearRect(0,0,canvas.width, canvas.height);
    redraw(undoList);
}
function redo(){
    if(!redoList.length)return;
    let redoAction = redoList.pop();
    undoList.push(redoAction);
    redraw([redoAction]);
}
// On commence à dessiner quand on enfonce le bouton de la souris
canvas.addEventListener("mousedown", startPosition);
// On arrête quand on le relève.
canvas.addEventListener("mouseup", finishedPosition);
// On dessine quand on déplace la souris.
canvas.addEventListener("mousemove", draw);
console.log(ctx.lineWidth);
// quand on appui sur une touche du clavier
document.addEventListener("keypress", keyboard);