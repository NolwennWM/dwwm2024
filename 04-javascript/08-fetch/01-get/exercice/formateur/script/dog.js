"use strict";
const url = "https://api.thedogapi.com/v1/images/search";
const mainD = document.querySelector('.exercice3 main');
const btnD = document.querySelector('.exercice3 button');
btnD.addEventListener("click", vaChercher);
function vaChercher()
{
    fetch(url).then(res=>{
        if(res.ok){
            res.json()
                .then(data=>{
                    console.log(data[0]);
                    mainD.innerHTML = `<img src="${data[0].url}" alt="image aléatoire d'animal">`;
                })
                .catch(err=>console.log(err.statusText))
        }
    })
}