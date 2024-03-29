"use strict";
export default class SuperDiv extends HTMLDivElement
{
    constructor()
    {
        super();
        this.setStyle();
        this.addEventListener("click", this.hide);
    }
    hide()
    {
        if(this.style.height === "1rem")
        {
            this.style.height = this.sizes.height +"px"
        }
        else
        {
            this.style.height = "1rem"
        }
    }
    setStyle()
    {
        this.style.display = "block";
        this.style.overflow = "hidden";
        this.style.backgroundColor = this.getAttribute("bg")??"red";
        this.style.transition = "height 0.3s linear";
        this.sizes = this.getBoundingClientRect();
        this.style.height = this.sizes.height + "px";
    }

    connectedCallback()
    {
        console.log("Element ajouté à la page");
    }
    disconnectedCallback()
    {
        console.log("Element retiré de la page");
    }
    adoptedCallback()
    {
        console.log("Element déplacé dans un autre document");
    }
    attributeChangedCallback(name, old, now)
    {
        console.log(`l'attribut "${name}" a changé`);
        console.log("anciennement :", old);
        console.log("maintenant :", now);
    }
    static get observedAttributes()
    {
        return ["style", "class"];
    }

}

customElements.define("super-div", SuperDiv, {extends: "div"});