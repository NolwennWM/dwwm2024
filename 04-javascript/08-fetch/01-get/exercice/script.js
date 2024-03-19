"use strict";

const url = "../hero.json";
const info = document.createElement("div");
const list = document.createElement("ul");

document.body.append(info, list);

fetch(url).then(handleFetch);

function handleFetch(response)
{
    if(response.ok)
    {
        response.json()
            .then(function(data){
                for(let r = 0; r < 4; r++)
                {
                    const hero = document.createElement("li");
                    hero.textContent = data.members[r].name;
                    hero.addEventListener("click", function(){
                        info.innerHTML = `<p>Name: ${data.members[r].name}</p>`;
                        info.innerHTML += `<p>Age: ${data.members[r].age}</p>`;
                        info.innerHTML += `<p>Secret Identity: ${data.members[r].secretIdentity}</p>`;
                        info.innerHTML += `<p>Powers: ${data.members[r].powers}</p>`;
                    })
                    list.append(hero);
                }
            })
            .catch(error=>console.error(error));
    }
}
// Exercice 2 :

const selectLangue = document.querySelector(".selectLangue");
const title = document.querySelector(".boite2 h2");
const text = document.querySelector(".boite2 p");

const lang = localStorage.getItem("lang");
const urlLangue = "./lang.json";

fetch(urlLangue).then(response=>{
    if(response.ok)
    {
        response.json().then(data=>{
            selectLangue.addEventListener("change", ()=>{
                if(selectLangue.value == "fr")
                {
                    title.textContent = data.welcome_message.fr;
                    text.textContent = data.text.fr;
                    localStorage.setItem("lang", "fr");
                }
                if(selectLangue.value == "en")
                {
                    title.textContent = data.welcome_message.en;
                    text.textContent = data.text.en;
                    localStorage.setItem("lang", "en");
                }
                if(selectLangue.value == "jap")
                {
                    title.textContent = data.welcome_message.jap;
                    text.textContent = data.text.jap;
                    localStorage.setItem("lang", "jap");
                }
            })
            if(lang)
            {
                selectLangue.value = lang;
                let event = new Event("change");
                selectLangue.dispatchEvent(event);
            }
        })
    }
})

// exo 3 :

const url2 = "https://api.thedogapi.com/v1/images/search";

fetch(url2).then(image);

function image(response)
{
    response.json().then(function(data){
        console.log(data);
        document.body.style.backgroundImage = `url("${data[0].url}")`;
    })
}