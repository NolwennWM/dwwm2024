"use strict";
/**
 * Application de dessin dans le style de paint.
 */
const paint = {
    /** Indique si l'utilisateur est en train de dessiner ou non */
    painting: false,
    /** Couleur utilisé pour dessiné */
    color: "black",
    /** Taille des traits */
    size: 10,
    /** Historique des actions de l'utilisateur */
    undoList: [], 
    /** Dernière action réalisé */
    lastAction: [], 
    /** Historique des actions qui ont été annulées */
    redoList: [],
    /** Canvas de l'application */
    canvas: document.createElement("canvas"),
    /**
     * Crée l'application de dessin avant de la retourner sous forme 
     * d'élément HTML.
     * @returns {HTMLCanvasElement} canvas contenant l'application.
     */
    create(){
        this.ctx = this.canvas.getContext("2d");
        window.addEventListener("resize", this.resize.bind(this));
        this.resize();
        // On commence à dessiner quand on enfonce le bouton de la souris
        this.canvas.addEventListener("mousedown", this.startPosition.bind(this));
        // On arrête quand on le relève.
        this.canvas.addEventListener("mouseup", this.finishedPosition.bind(this));
        // On dessine quand on déplace la souris.
        this.canvas.addEventListener("mousemove", this.draw.bind(this));
        // quand on appui sur une touche du clavier
        document.addEventListener("keypress", this.keyboard.bind(this));
        return this.canvas;
    },
    /**
     * Adapte la taille du canvas à son parent ou à la fenêtre
     * @returns {void}
     */
    resize(){
        let snapshot = this.ctx.getImageData(0,0, this.canvas.width, this.canvas.height)
        // Si on a un parent, on adapte la taille du canvas à celui du parent, sinon à celui du viewport
        if(this.canvas.parentElement){
            this.canvas.width = this.canvas.parentElement.offsetWidth;
            this.canvas.height = this.canvas.parentElement.offsetHeight;
        }
        else
        {
            this.canvas.width = window.innerWidth;
            this.canvas.height = window.innerHeight;
        }
        this.ctx.putImageData(snapshot, 0, 0)
        this.setContext();
    },
    setContext()
    {
        this.ctx.lineWidth = this.size;
        this.ctx.strokeStyle = this.color;
    },
    /**
     * Indique à l'application que l'utilisateur à commencé à dessiner.
     * @param {MouseEvent} e évènement de souris
     */
    startPosition(e){
        this.painting = true;
        // pour faire des points au clique
        this.draw(e);
    },
    /**
     * Indique à l'application que l'utilisateur a fini de dessiner.
     * Puis sauvegarde la dernière action dans l'historique.
     */
    finishedPosition(){
        this.painting = false;
        this.ctx.beginPath();
        this.undoList.push(this.lastAction);
        this.lastAction = [];
    },
    /**
     * Dessine là où se trouve la souris puis
     * sauvegarde les mouvement de la souris.
     * @param {MouseEvent} e évènement de souris
     * @returns 
     */
    draw(e){
        // Si on n'est pas en train de dessiner, on arrête la fonction.
        if(!this.painting) return;
        // this.ctx.lineWidth = this.size;
        // this.ctx.strokeStyle = this.color;
        this.ctx.lineCap = "round";
        let mouse = this.getMousePos(e);
        /* On dessine là où se trouve la souris. */
        this.ctx.lineTo(mouse.x, mouse.y);
        this.ctx.stroke();
        // on augmente un peu la fluidité avec ceci: (optionnelle)
        this.ctx.beginPath();
        this.ctx.moveTo(mouse.x, mouse.y);
        this.lastAction.push({
            x: mouse.x,
            y: mouse.y,
            color: this.color,
            size: this.size
        })
    },
    /**
     * Retourne la position de la souris dans le canvas.
     * @param {MouseEvent} evt évènement de souris
     * @returns {{x:Number, y:Number}} Objet contenant la position de la souris
     */
    getMousePos(evt) {
        var rect = this.canvas.getBoundingClientRect();
        return {
            x: evt.clientX - rect.left,
            y: evt.clientY - rect.top
        };
    },
    /**
     * Redessine les différents traits tracé selon l'historique donné
     * en argument.
     * @param {Array<Array<{x:number, y:number, color:string, size:string|number}>>} tab tableau d'historique des mouvements
     */
    redraw(tab){
        tab.forEach(action =>{
            this.ctx.beginPath();
            action.forEach(move=>{
                this.ctx.strokeStyle = move.color;
                this.ctx.lineWidth = move.size;
                this.ctx.lineTo(move.x, move.y);
                this.ctx.stroke();
                this.ctx.beginPath();
                this.ctx.moveTo(move.x, move.y);
            })
        })
        this.ctx.beginPath();
    },
    /**
     * Lance la fonction correspondante au raccourci clavier utilisé.
     * @param {KeyboardEvent} e évènement au clavier
     */
    keyboard(e){
        e.preventDefault();
        if(!this.canvas.parentElement)return;
        // Selon la touche pressé je lance différente fonctions.
        switch(e.key.toLowerCase()){
            case "s":
                this.save();
                break;
            case "l":
                this.load();
                break;
            case "c":
                this.chooseColor();
                break;
            case "z":
                this.undo();
                break;
            case "y":
                this.redo();
                break;
            case "+":
                this.size++;
                console.log(this.size);
                break;
            case "-":
                this.size = this.size<=1?1:--this.size;
                console.log(this.size);
                break;
        }
        this.setContext();
    },
    /**
     * Permet de charger une image dans le canvas.
     */
    load(){
        // je crée un nouvel element input
        let input = document.createElement("input");
        // je lui donne le type file
        input.setAttribute("type", "file");
        // je le clique
        input.click();
        // Quand je rentre un fichier.
        let that = this;
        input.oninput = function(e){
            // Je crée un lecteur de fichier.
            let reader = new FileReader();
            // quand je charge un fichier dans mon lecteur
            reader.onload = function(event){
                //je crée une nouvelle image.
                let img = new Image();
                // quand mon image est chargé:
                img.onload = function(){
                    // je vide mon canvas
                    that.ctx.clearRect(0,0,that.canvas.width, that.canvas.height);
                    //J'ajoute ma nouvelle image
                    that.ctx.drawImage(img, 0,0);
                }
                /* J'ajoute à la source de mon image ce que me retourne
                mon lecteur */
                img.src = event.target.result;
            }
            // Je donne à mon lecteur, le fichier selectionné.
            reader.readAsDataURL(e.target.files[0]);
        }
    },
    /**
     * Permet de sauvegarder le canvas actuel au format png.
     */
    save(){
        /* On change les données du canvas en donnée png sous forme de
        string */
        let png = this.canvas.toDataURL("image/png");
        /* On vient remplacer son type mime par un autre plus apte
        au transfère de donnée. */
        png.replace("image/png", "application/octet-stream");
        // Je crée un lien
        let link = document.createElement("a");
        // Je viens lui ajouter l'attribut download avec le nom du fichier.
        link.setAttribute("download", "SauvegardeCanvas.png");
        // On lui ajoute son href avec mon image en valeur.
        link.setAttribute("href", png);
        // et on le clique
        link.click();
    },
    /**
     * Permet de changer la couleur des traits
     */
    chooseColor(){
        // Je crée un nouvel element input
        let input = document.createElement("input");
        // je lui donne le type color
        input.setAttribute("type", "color");
        // et je clique dessus
        input.click();
        // Lorsque je rentre une couleur dans mon input
        input.oninput = function(e){
            // je donne sa valeur à ma variable color.
            this.color = e.target.value;
            this.setContext();
        }.bind(this)
    },
    /**
     * Permet d'annuler les dernières actions effectuées.
     * @returns {void}
     */
    undo(){
        if(!this.undoList.length)return;
        let redoAction = this.undoList.pop();
        this.redoList.push(redoAction);
        this.ctx.clearRect(0,0,this.canvas.width, this.canvas.height);
        this.redraw(this.undoList);
    },
    /**
     * Permet de refaire une action précédement annulée.
     * @returns {void}
     */
    redo(){
        if(!this.redoList.length)return;
        let redoAction = this.redoList.pop();
        this.undoList.push(redoAction);
        this.redraw([redoAction]);
    }
}
export default paint;