/*
    1.Le champ nom d'utilisateur doit tourner au rouge si 
    il contient autre chose que des lettres, - ou _;

    2.Le champ téléphone doit passer au rouge si le ce qui est entré
    ne correspond pas à un numéro de téléphone.

    3.Le champ email doit passer au rouge si ce qui est entré ne 
    correspond pas à un email.

    4.Ajouter une barre de progression qui change de couleur
    et se rempli à chaque fois que l'utilisateur sécurise 
    un peu plus sont mdp :
        -lettre minuscule.
        -lettre majuscule.
        -chiffre.
        -caractère spécial.
        -au moins 8 caractère.
        
    5. le champ mdp bis doit tourner au rouge si il ne correspond 
    pas au champ mdp.
    (le changement au rouge peut être personalisé autrement,
    l'important est de montrer à l'utilisateur qu'il se trompe)
 */

"use strict";

let tel = document.querySelector("#tel");
let mail = document.querySelector("#email");
const telRegex = /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/gmi;
const mailRegex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/g;

tel.addEventListener("input", verifTel);
mail.addEventListener("input", verifMail);

function verifTel()
{
    if(telRegex.test(tel.value) == true)
    {
        tel.style.backgroundColor = "";
    }
    else if(tel.value == "")
    {
        tel.style.backgroundColor = "";
    }
    else
    {
        tel.style.backgroundColor = "red";
    }
}

function verifMail()
{
    if(mailRegex.test(mail.value) == true || mail.value == "")
    {
        mail.style.backgroundColor = "";
    }
    else
    {
        mail.style.backgroundColor = "red";
    }
}

let pseudo = document.querySelector('#pseudo');
let password = document.querySelector('#password');
let password2 = document.querySelector('#verifPassword');
let strongBar = document.querySelector('.strong');

const pseudoRegex = /^[A-Za-z]{3,}$/;
const passwordRegex1 = /[a-zéèàçùêâ]+/;
const passwordRegex2 = /[A-Z]+/;
const passwordRegex3 = /[0-9]+/;
const passwordRegex4 = /[#?!@$%^&*-]+/;
const passwordRegexComplete = /^[a-zéèàçùêâA-Z0-9#?!@$%^&*-]{1,}$/

pseudo.addEventListener("input", verifPseudo);
password.addEventListener("input", verifPassword);
password2.addEventListener("input", verifPassword2);

function verifPseudo()
{
    if(pseudoRegex.test(pseudo.value) == true || pseudo.value == "")
    {
        pseudo.style.backgroundColor = "";
    }
    else
    {
        pseudo.style.backgroundColor = "red";
    }
}
function verifPassword()
{
    if(passwordRegexComplete.test(password.value) === true)
    {
        let strong = 0;
        if(passwordRegex1.test(password.value))
        {
            strong++;
        }
        if(passwordRegex2.test(password.value))
        {
            strong++;
        }
        if(passwordRegex3.test(password.value))
        {
            strong++;
        }
        if(passwordRegex4.test(password.value))
        {
            strong++;
        }

        if(strong == 1)
        {
            strongBar.style.backgroundColor = "red";
            strongBar.style.width = "25%";
        }
        else if(strong == 2)
        {
            strongBar.style.backgroundColor = "orange";
            strongBar.style.width = "50%";
        }
        else if(strong == 3)
        {
            strongBar.style.backgroundColor = "yellow";
            strongBar.style.width = "75%";
        }
        else if(strong == 4)
        {
            strongBar.style.backgroundColor = "green";
            strongBar.style.width = "100%";
        }
    }
    else if(password.value == "")
    {
        password.style.backgroundColor = "";
    }
    else
    {
        password.style.backgroundColor = "red";
    }
}

function verifPassword2()
{
    if(password2.value === password.value || password2.value == "")
    {
        password2.style.backgroundColor = "";
    }
    else
    {
        password2.style.backgroundColor = "red";
    }
}