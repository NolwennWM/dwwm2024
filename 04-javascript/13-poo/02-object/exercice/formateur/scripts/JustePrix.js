"use strict";
/**
 * Jeu de juste prix choisissant un nombre aléatoire
 * puis laisse l'utilisateur deviner ce nombre en indiquant
 * si la cible est plus grande ou plus petite.
 */
const Game = {
    /** input pour les réponses de l'utilisateur */
    input: document.createElement("input"),
    /** button pour valider la réponse de l'utilisateur */
    btn: document.createElement("button"),
    /** p contenant les messages du jeu */
    p: document.createElement("p"),
    /**
     * Crée le jeu et le retourne sous forme de div
     * @returns {HTMLDivElement} div contenant le jeu
     */
    create(){
        this.input.setAttribute("type","number");
        this.btn.textContent = "Tenter";
        this.p.textContent = "Choisi un nombre entre 0 et 100";
        
        const div = document.createElement("div");
        div.style.display = "flex";
        div.style.flexDirection = "column";
        div.style.alignItems = "center";
        div.append(this.p, this.input, this.btn);

        this.btn.addEventListener("click", this.check.bind(this));
        this.start();
        return div;
    },
    /**
     * Choisi un nombre aléatoire
     */
    start(){
        this.target = Math.floor(Math.random()*100);
        this.input.focus();
    },
    /**
     * Vérifie la réponse de l'utilisateur.
     */
    check(){
        if(this.input.value <this.target){
            this.p.textContent = "C'est plus grand !";
        }else if(this.input.value > this.target){
            this.p.textContent = "C'est plus petit !";
        }else{
            this.p.textContent= "Félicitation tu as gagné !";
            this.btn.disabled = true;
        }
        this.input.value = "";
        this.input.focus();
    }
}
export default Game;