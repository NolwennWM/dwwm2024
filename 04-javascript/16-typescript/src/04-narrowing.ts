/* 
    Le narrowing c'est le fait de rétrécir (supprimer) des possibilités de type pour nos variables et arguments :
*/
function birthday(age: string|number): string
{
    // age peut être un string, donc cela provoque une erreur
    // age++
    if(typeof age === "number")
    {
        age++;
    }
    else
    {
        age = parseInt(age)+1;
    }
    /* 
        Dans le if typescript comprend que age est forcément un nombre
        et dans le else, forcément un string

        Si je concatène mon nombre, ts comprend que c'est un string.
    */
    return age+ " ans";
}

function chaussette(droite: string|boolean, gauche: string|number): void
{
    if(droite === gauche)
    {
        console.log(" Vous avez la paire !", gauche, droite);
    }
    /* 
        Dans cette condition, nos deux éléments sont forcément des strings
        car c'est la seule façon qu'ils ont d'être strictement égale.
    */
}

function planning(date: Date|string, days:string[]|number)
{
    // date.getDate();
    if(date instanceof Date)
    {
        date.getDate();
    }
    // days++
    if(!Array.isArray(days))
    {
        days++
    }
}

function clavier(e:KeyboardEvent|HTMLElement)
{
    if(typeof e === "number")
    {
        console.log(e);        
    }
    /* 
        Le type "never" indique que selon TS, 
        C'est impossible d'avoir un type valide ici
    */
}
/* 
    "paramètre is Objet" permet d'indiquer à typescript
    que la fonction retourne un boolean indiquant le type du paramètre.

    ici en indiquant "a is Date" typescript comprend que le boolean de retour,
    Indique si le paramètre "a" est une "Date" ou non.
*/
// function isDate(a:any): boolean
function isDate(a:any): a is Date
{
    return a instanceof Date;
}

function check(a:Date|HTMLElement)
{
    if(isDate(a))
    {
        console.log(a.getDate());        
    }
}