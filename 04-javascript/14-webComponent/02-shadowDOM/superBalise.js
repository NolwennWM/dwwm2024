export default class SuperBalise extends HTMLElement
{
    constructor()
    {
        super();
        this.attachShadow({mode:"open"});
        this.info = document.createElement("div");

        this.shadowRoot.textContent = this.getAttribute("text")||"rien à voir";
        this.info.textContent = this.getAttribute("hide")||"rien à voir";
        this.shadowRoot.append(this.info);

        this.initStyle();
        this.addEventListener("mouseenter", this.toggle);
        this.addEventListener("mouseleave", this.toggle);
    }
    toggle()
    {
        if(this.info.style.display === "")
        {
            this.info.style.display = "block"
        }else
        {
            this.info.style.display = ""
        }
    }
    initStyle()
    {
        const style = document.createElement("style");
        this.shadowRoot.append(style);
        style.textContent = /* CSS */
        `
            :host
            {
                font-weight: 900;
                color: red;
                position: relative;
            }
            div
            {
                position: absolute;
                bottom: -2rem;
                right: -1rem;
                border: 2px solid blue;
                border-radius: 5px;
                background-color: rgba(0,0,255,0.7);
                color: yellow;
                display: none;
            }
        `
    }
}

customElements.define("super-balise", SuperBalise);