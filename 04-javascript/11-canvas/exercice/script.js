const canvas = document.querySelector('canvas');

function resize()
{
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
}
resize();
window.addEventListener("resize", resize);

const ctx = canvas.getContext("2d", {willReadFrequently: true});

ctx.lineWidth = 15;
ctx.lineCap = "round";

let snapshot1 = ctx.getImageData(0,0, canvas.width, canvas.height);
let snapshot2 = ctx.getImageData(0,0, canvas.width, canvas.height);
let painting = false;

canvas.onmousedown = ()=>{
    painting = true;
    snapshot1 = ctx.getImageData(0,0, canvas.width, canvas.height);
}
canvas.onmouseup = ()=>{
    painting = false;
    snapshot2 = ctx.getImageData(0,0, canvas.width, canvas.height);
}
/**
 * 
 * @param {MouseEvent} m 
 * @returns 
 */
canvas.onmousemove = (m)=>{
    if(painting == false)return;
    else
    {
        ctx.beginPath();
        ctx.moveTo(m.clientX, m.clientY);
        ctx.lineTo(m.clientX, m.clientY);
        ctx.stroke();
    }
}
const colorSelector = document.querySelector("#selectColor");
colorSelector.addEventListener("input", changeColor);

function changeColor()
{
    ctx.fillStyle = colorSelector.value;
    ctx.strokeStyle = colorSelector.value;
}

const sizeSelector = document.querySelector('#selectSize');
sizeSelector.addEventListener("input", changeSize);

function changeSize()
{
    ctx.lineWidth = sizeSelector.value;
}

const cancelButton = document.querySelector('#cancelButton');
cancelButton.addEventListener("click", cancelMove);

function cancelMove()
{
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.putImageData(snapshot1, 0, 0);
}
const remakeButton = document.querySelector('#remakeButton');
remakeButton.addEventListener("click", remakeMove);

function remakeMove()
{
    ctx.putImageData(snapshot2, 0, 0);
}
