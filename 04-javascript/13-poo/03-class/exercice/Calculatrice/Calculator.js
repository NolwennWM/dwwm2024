export default class Calculator {
  constructor() {
    this.create()
    this.clear()
  }
  create(){
    const calc = document.createElement("div");
    calc.classList.add("calculator-grid");
    const output = document.createElement("div");
    output.classList.add("output");
    const prev = document.createElement("div");
    prev.classList.add("previous-operand");
    const current = document.createElement("div");
    current.classList.add("current-operand");
    output.append(prev, current);
    calc.append(output)
    this.previous = prev;
    this.current = current;
    const btns = ["AC", "DEL", "÷",1,2,3,"*",4,5,6,"+",7,8,9,"-",".",0,"="];
    for(let b of btns){
      const btn = document.createElement("button");
      btn.textContent = b;
      calc.append(btn);
      switch(b){
        case "AC":
          btn.classList.add("span-two");
          btn.addEventListener("click", this.clear.bind(this));
          break;
        case "DEL":
          btn.addEventListener("click", this.delete.bind(this));
          break;
        case "=":
          btn.classList.add("span-two");
          btn.addEventListener("click", this.compute.bind(this));
          break;
        default:
          if(typeof b === "number" || b ==="."){
            btn.addEventListener("click", this.appendNumber.bind(this));
          }else{
            btn.addEventListener("click", this.chooseOperation.bind(this))
          }
          
      }
      btn.addEventListener("click", this.updateDisplay.bind(this))
    }
    this.calc = calc;
  }
  clear() {
	  // Lorsque l'on clear un élément on vide les chiffres en mémoire et l'opérateur
    this.currentOperand = ''
    this.previousOperand = ''
    this.operation = undefined
  }

  delete() {
	  //Quand on supprime, on retire du chiffre actuel le dernier element.
    this.currentOperand = this.currentOperand.toString().slice(0, -1)
  }

  appendNumber(e) {
	  // Si on tente d'ajouter un "." alors qu'il y en a déjà un, on arrête la fonction
    console.log(this.currentOperand);
    if (e.target.innerText === '.' && this.currentOperand.includes('.')) return
	// sinon on concatène les chiffres
    this.currentOperand = this.currentOperand.toString() + e.target.innerText.toString()
  }

  chooseOperation(e) {
	  //Si on a aucun chiffre selectionné, on arrête la fonction.
    if (this.currentOperand === '') return
	// si on a déjà un opérateur choisi, alors on calcul notre résultat 
    if (this.previousOperand !== '') {
      this.compute()
    }
	// puis on sauvegarde notre opérateur, et notre nombre actuel devient le précédent.
    this.operation = e.target.innerText;
    this.previousOperand = this.currentOperand
    this.currentOperand = ''
  }

  compute() {
    let computation
	// on transforme nos chaînes de caractères en nombres.
    const prev = parseFloat(this.previousOperand)
    const current = parseFloat(this.currentOperand)
	// Si un des deux n'est pas un nombre, on arrête la fonction.
    if (isNaN(prev) || isNaN(current)) return
	// on fait le calcul qui correspond à l'opérateur.
    switch (this.operation) {
      case '+':
        computation = prev + current
        break
      case '-':
        computation = prev - current
        break
      case '*':
        computation = prev * current
        break
      case '/':
      case '÷':
        computation = prev / current
        break
      default:
        return
    }
	// notre résultat devient notre nombre actuel, et on vide les autres valeurs.
    this.currentOperand = computation
    this.operation = undefined
    this.previousOperand = ''
  }

  getDisplayNumber(number) {
    // Peut avoir son utilité mais gère mal les grands nombres ou les longues virgules.
    // return new Intl.NumberFormat("fr-FR").format(number);
	  // On transforme le nombre fourni en chaîne de caractère
    const stringNumber = number.toString()
	// on sépare ce qui se trouve avant et après la virgule.
    const integerDigits = parseFloat(stringNumber.split('.')[0])
    const decimalDigits = stringNumber.split('.')[1]
    let integerDisplay
	//Si la partie avant la virgule n'est pas un nombre, alors cela devient une chaîne de caractère vide.
    if (isNaN(integerDigits)) {
      integerDisplay = ''
    } else {
		// Sinon on transforme ce nombre en affichage français (espaces tout les trois chiffres);
		// l'option maximumFractionDigits permet de retirer toute décimal présente.
      integerDisplay = integerDigits.toLocaleString('fr', { maximumFractionDigits: 0 })
    }
	// Si on a des décimals alors on retourne notre nombre en entier
  // return new Intl.NumberFormat("fr-Fr", {maximumFractionDigits: 40}).format(number);
  
  if (decimalDigits != null) {
      return `${integerDisplay},${decimalDigits}`
    } else {
		// sinon on retourne juste l'entier.
      return integerDisplay
    }
  }

  updateDisplay() {
	  // On affiche dans l'écran du bas le nombre actuel au format voulu
    this.current.innerText =
      this.getDisplayNumber(this.currentOperand)
	  //si on a une opération de selectionné
    if (this.operation != null) {
		// On affiche dans l'écran du haut le nombre précédent avec l'opérateur
      this.previous.innerText =
        `${this.getDisplayNumber(this.previousOperand)} ${this.operation}`
    } else {
		// sinon l'écran du haut est vide.
      this.previous.innerText = ''
    }
  }
}
