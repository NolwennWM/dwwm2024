"use strict";
const del = document.querySelectorAll('a[href*="delete"]');

if(del.length){
    del.forEach(d=>d.addEventListener("click",e=>{
        if(!confirm("Êtes vous sûr de vouloir supprimer cela?"))
        {
            e.preventDefault();
        }
    }))
}
// Version 1 ligne :
// if(del.length)del.forEach(d=>d.addEventListener("click",e=>{if(!confirm("Êtes vous sûr de vouloir supprimer cela?"))e.preventDefault()}));