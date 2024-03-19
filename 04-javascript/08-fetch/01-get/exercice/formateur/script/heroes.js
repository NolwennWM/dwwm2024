"use strict";

const heroes = document.querySelector('#heroes');
const mainH = document.querySelector('.exercice1 main');
let heros;
heroes.addEventListener("input", selectHero);
getHeroes();
function getHeroes()
{
    fetch("../hero.json").then(resp=>{
        if(resp.ok)
        {
            resp.json().then(data=>{
                heros = data.members;
                for(let choix in heros)
                {
                    console.log(choix);
                    const op = document.createElement("option");
                    op.value = choix;
                    op.textContent = heros[choix].name;
                    heroes.append(op);
                }
                heroes.disabled = false;
            })
        }
    })
}
function selectHero()
{
    for(let op of heroes.options)
    {
        let h = heros[op.value]
        // si l'option est selectionné, que le héro correspondant existe et qu'il n'a pas déjà été selectionné
        if(op.selected && h && !h.select)
        {
            h.select = createUl(h, mainH);
        }
        // si l'option n'est pas selectionné, que le héro existe et qu'il était selectionné avant.
        else if(!op.selected && h && h.select)
        {
            h.select.remove();
            delete h.select;
        }
    };
}
function createUl(data, parent)
{
    const ul = document.createElement("ul");
    for (const info in data) {
        const li = document.createElement("li");
        if(typeof data[info] == "string" || typeof data[info] == "number" )
        {
            li.append(`${info} : ${data[info]}`);
        }
        else if(data[info] && typeof data[info] == "object"){
            li.append(info+" :")
            createUl(data[info], li);
        }
        ul.append(li);
    }
    parent.append(ul);
    return ul;
}