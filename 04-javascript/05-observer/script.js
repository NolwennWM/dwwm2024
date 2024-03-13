"use strict";
const 
    indicator = document.querySelector(".scroll-indicator"),
    main = document.querySelector("main"),
    options = {
        /* 
            Dans quel élément l'observation se fait, 
            par défaut le viewport, mais on pourrait détecter l'intersection dans un autre élément.
        */
        // root: main
        /* 
            permet de changer à partir d'où se fait la détection
            une valeur positive provoquera la détection avant l'entré dans le viewport
            Une valeur négative le fera après sont arrivé dans le viewport
        */
        // rootMargin: "50px"
        /* 
            Indique le pourcentage visible de l'élément (entre 0 et 1)
            qui doit être dans le viewport pour déclencher l'action.
        */
        // threshold: 0.05
    };
    
/* 
    Les observers sont des objets permetant un peu comme un écouteur d'évènement, 
    d'attendre une action dans la page pour lancer une fonction.

    On trouvera par exemple le mutation observer qui attend un changement dans le HTML.

    Ou celui qu'on testera ici, l'intersection observer qui attend qu'un élément HTML entre ou sort du viewport.

    Dans ce premier exemple on activera un "addEventListener" quand le main entre dans le viewport et on le retirera quand il sortira du viewport.
    Cela peu servir à alléger la page lorsqu'un évènement ne sert à rien.

    L'intersection observer se présente comme une classe à instancier avec en premier paramètre, une fonction callback et en second, des possibles options sous forme d'objet.
*/
const observer = new IntersectionObserver(setIndicator, options);
/* 
    L'observer a besoin qu'on lui indiquer quel élément HTML il doit observer :
*/
observer.observe(main);
/* 
    La fonction callback sera lancé à chaque fois qu'un élément obersé entre ou quitte le viewport.
    Elle va récupérer en argument, un tableau contenant une entré pour chaque élément observé entre ou quittant le viewport.
*/
function setIndicator(entries)
{
    // console.log(entries);
    /* 
        Au chargement de la page, la fonction est appelé une première fois,
        Cela pour indiquer si les éléments observés sont déjà présent ou non.
        Dans notre cas, on observe qu'un seul élément, donc pour éviter de travailler avec un tableau, j'utilise une nouvelle variable :
    */
    const entry = entries[0];

    // console.log(entry);

    if(entry.isIntersecting)
    {
        window.addEventListener("scroll", indicatorAnimation);
    }
    else
    {
        window.removeEventListener("scroll", indicatorAnimation);
    }
}
/* 
    Si on souhaite arrêté une observation, on peut utiliser :
    observer.unobserve(main)
    Si on souhaite supprimer toute les observations :
    observer.disconnect()
*/
function indicatorAnimation()
{
    // console.log("SCROOOLLL!!");
    /* 
        scrollY représente le nombre de pixel scrollé
        offsetTop la position de l'élément par rapport au haut de la page
    */
    if(window.scrollY > main.offsetTop)
    {
        /* 
            "scrollHeight" la hauteur de l'élément incluant le padding vertical.
            "nombre.toFixed(n)" retourne un string d'un nombre avec "n" chiffre après la virgule
        */
        const prc = ((window.scrollY - main.offsetTop)/main.scrollHeight).toFixed(2);
        // console.log(prc);
        indicator.style.transform = `scale(${prc})`;
    }
    else
    {
        indicator.style.transform = "";
    }
}