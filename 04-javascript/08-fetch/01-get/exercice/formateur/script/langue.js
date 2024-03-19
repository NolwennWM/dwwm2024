"use strict";

const langues = document.querySelector('#langues');
const h1 = document.querySelector('h1');
const p = document.querySelector('p');
let lang;
langues.addEventListener("input", selectLangue);
getLangues();
function getLangues()
{
    fetch("./script/lang.json").then(resp=>{
        if(resp.ok)
        {
            resp.json().then(data=>{
                lang = data;
                for(let choix in lang)
                {
                    console.log(choix);
                    const op = document.createElement("option");
                    op.value = choix;
                    op.textContent = lang[choix].name;
                    langues.append(op);
                }
                langues.disabled = false;
                // récupération du choix utilisateur :
                let defaut = navigator.language.slice(0,2);
                let l = localStorage.getItem("langue");
                if(l)
                    setLangue(l)
                else if(lang.hasOwnProperty(defaut))
                    setLangue(defaut)
                else
                    setLangue("fr");
            })
        }
    })
}
function setLangue(l)
{
    let op = langues.querySelector(`[value="${l}"]`)
    if(op)
    {
        op.selected = true;
        selectLangue();
    }
}
function selectLangue()
{
    let l = lang[langues.value]
    if(l)
    {
        document.documentElement.lang = langues.value;
        localStorage.setItem("langue", langues.value);
        h1.textContent = l.title;
        p.textContent = l.description;
    }
}