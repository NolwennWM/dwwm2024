export default class SuperBalise extends HTMLElement
{
    constructor()
    {
        super();
        this.info = document.createElement("div");
        this.info.textContent = this.getAttribute("text")||"rien à voir";
        this.append(this.info);

        this.initStyle();
        this.addEventListener("mouseenter", this.toggle);
        this.addEventListener("mouseleave", this.toggle);
    }
    toggle()
    {
        if(this.info.style.display === "")
        {
            this.info.style.display = "none"
        }else
        {
            this.info.style.display = ""
        }
    }
    initStyle()
    {
        this.style.fontWeight = 900;
        this.style.color = "red";
        this.style.position = "relative";
        
        const info = this.info;
        info.style.position = "absolute";
        info.style.bottom = "-2rem";
        info.style.right = "-1rem";
        info.style.border = "2px solid blue";
        info.style.borderRadius = "5px";
        info.style.backgroundColor = "rgba(0,0,255, 0.5)";
        info.style.color = "yellow";
        info.style.display = "none";
    }
}

customElements.define("super-balise", SuperBalise);