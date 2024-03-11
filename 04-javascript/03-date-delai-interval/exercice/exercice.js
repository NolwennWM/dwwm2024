const heure = document.getElementById('heure');
const minute = document.getElementById('minute');
const seconde = document.getElementById('seconde');

function setClock()
{
    const now = new Date();
    const h = now.getHours();
    const m = now.getMinutes();
    const s = now.getSeconds();

    const hAngle = (h % 12) * 30 + (m/60)*30;
    const mAngle = m*6 + (s/60)* 6;
    const sAngle = s*6;
    
    heure.style.transform = `rotate(${hAngle}deg)`;
    minute.style.transform = `rotate(${mAngle}deg)`;
    seconde.style.transform = `rotate(${sAngle}deg)`;
}

setInterval(setClock, 1000);
setClock();