const para = document.querySelectorAll('p');
const size = 200;
let currentSize = size;

para.forEach(p=>{
    p.addEventListener("mouseenter", turnOnLight);
    p.addEventListener("mousemove", moveLight);
    p.addEventListener("mouseleave", turnOffLight);
});

function moveLight(e)
{
    const pos = this.getBoundingClientRect();
    const x = e.clientX - pos.left - currentSize/2;
    const y = e.clientY - pos.top - currentSize/2;
    this.style.backgroundPosition = `${x}px ${y}px`;
}
function turnOnLight()
{
    currentSize = size;
    this.style.backgroundSize = `${currentSize}px ${currentSize}px`;
}
function turnOffLight(e)
{
    // TODO : réduire la taille sur le point de sortie .
    // currentSize = 0;
    // this.style.backgroundSize = `${currentSize}px ${currentSize}px`;
    // const pos = this.getBoundingClientRect();
    // const x = e.clientX - pos.left;
    // const y = e.clientY - pos.top;
    // setTimeout(()=>this.style.backgroundPosition = `${x}px ${y}px`, 300)
    this.style.backgroundPosition = "" ;
}