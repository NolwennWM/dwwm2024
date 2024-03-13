"use strict";
/*
 * ---------------- EXO 1 --------------------
 * 1. Rendre tous les paragraphes du main, invisible.
 * 2. Ajouter Une observation sur chaque paragraphes.
 * 3. Lorsque l'élément est au moins à moitié dans le viewport, le rendre visible.
 * 4. Désactiver la détection de l'élément une fois l'action terminé.
 * (Bonus). Faire venir avec une animation.
 * ---------------- EXO 2 ----------------------
 * 1. Lorsque le dernier paragraphe est à 200px en dessous du viewport.
 *      Créer 10 paragraphes et les ajouter à la suite du main.
 * 2. Désactiver la détection du précédent dernier paragraphe.
 * 3. Ajouter l'animation de l'exercice 1 aux nouveaux paragraphes.
 * 4. Ajouter la détection du dernier paragraphe au nouveau dernier paragraphe.
 */

const paragraphes = document.querySelectorAll("main p");

const obs = new IntersectionObserver(reveal, {threshold: 0.5});

for(let i = 0; i < paragraphes.length; i++)
{
    obs.observe(paragraphes[i]);
}

function reveal(entries)
{
    // console.log(entries);
    for(let i = 0; i < entries.length; i++)
    {
        const entry = entries[i];
        // console.log(entry);
        if(entry.isIntersecting)
        {
            entry.target.style.opacity = "1";
            obs.unobserve(entry.target);
        }
    }
}

// exo 2 :

const lastP = document.querySelector('main p:last-child');

const obs2 = new IntersectionObserver(newPara, {rootMargin: "200px"});

obs2.observe(lastP);

function newPara(entries)
{
    if(entries[0].isIntersecting)
    {
        let p;
        for(let i = 0; i < 10; i++)
        {
            p = document.createElement("p");
            p.textContent = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque repudiandae ab voluptas quas delectus laudantium consequatur aspernatur tenetur, vero, fugiat harum non error officia inventore accusantium corporis vitae odio amet?";
            document.querySelector("main").append(p);
            obs.observe(p);
        }
        obs2.unobserve(lastP);
        obs2.observe(p);
    }
}