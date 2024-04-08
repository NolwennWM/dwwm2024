/* 
    Les interfaces sont à la jonction entre les types et les classes abstraite.
    à la différente des classes abstraites, l'interface ne contiendra que des déclarations, aucune définition.
    à la différence des types, l'interface sera réservé aux objets, et pourra être redéfini
*/
type Chaussette = string;
// Impossible de redéfinir un type
// type Chaussette = number;

interface Point
{
    x: number;
    y: number;
    get():number;
}
// La propriété z est ajouté à l'interface "Point"
interface Point {z: number};

/* 
    vsCode utilise des interfaces en typescript pour indiquer ce que contiennent les différents objets de Javascript.

    Ici je fais croire à vsCode que les objets "document" contiennent une propriété "chaussette".
    Ce qui n'est évidement pas le cas.
*/
interface Document {chaussette: string}
document.chaussette
/* 
    Pour utiliser une interface sur une classe
    On utilise le mot clef "implements"
    Ensuite la classe devra définir tout ce qui est demandé par l'interface.
*/
class Point3D implements Point
{
    x = 0;
    y = 0;
    z = 0;
    get(){return this.x};
}
// On peut typer un paramètre avec une interface.
function show(p: Point){}
show(new Point3D);