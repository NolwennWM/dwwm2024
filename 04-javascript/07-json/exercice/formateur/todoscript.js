"use strict";
/**
 * 1. Créer une todo list. à chaque appui sur le bouton ajout,
 * créer un nouvel élément dans la liste.
 * cet élément doit contenir la valeur de l'input et une croix.
 * On en profitera pour vider l'input.
 * 2. le clique sur un élément de la liste lui ajoutera une classe qui aura pour 
 * effet de barrer l'élément.
 * 3. le clique sur la croix supprimera l'élément concerné.
 * 4. sauvegarder la liste en localstorage.
 * 5. afficher la liste sauvegardé au chargement de la page.
 * 6. éditer la liste lorsque l'on coche ou supprime un élément.
 * Bonus : Utiliser le drag and drop pour déplacer nos éléments dans la liste. il faudra penser à sauvegarder les éléments déplacé.
 */
const ulTodo = document.querySelector('#list');
const liTodo = document.querySelectorAll('li');
const btnTodo = document.querySelector('.addBtn');
const inputTodo = document.querySelector('#addTodo');
let listInfo = {};

liTodo.forEach(addClose);
btnTodo.addEventListener("pointerdown", addLi);

function addClose(div) {
    const span = document.createElement("span");
    span.textContent = "\u00D7";
    span.classList.add("close");
    div.append(span);
    span.addEventListener("pointerdown", closeLi)
    div.addEventListener("click", checkLi)
}

function closeLi(e) {
    e.stopPropagation();
    let div = e.target.parentElement;
    delete listInfo[div.dataset.time];
    localStorage.setItem("todoList", JSON.stringify(listInfo));
    div.parentElement.remove();
}

function checkLi(e) {
    this.classList.toggle('checked');
    // console.log(this);
    listInfo[this.dataset.time].checked = this.classList.contains("checked");
    localStorage.setItem("todoList", JSON.stringify(listInfo));
}

function addLi() {
    if (inputTodo.value === '') {
        alert("Ne laisse pas ce champ vide !");
    } else {
        const li = document.createElement("li");
        const div = document.createElement("div");
        div.textContent = inputTodo.value;
        div.dataset.time = Date.now();
        li.append(div);
        ulTodo.append(li);
        addClose(div);
        addEventsDragAndDrop(div);
        // console.log(listInfo);
        listInfo[div.dataset.time] = {value: inputTodo.value, checked: false};
        localStorage.setItem("todoList", JSON.stringify(listInfo));
        inputTodo.value = "";
        inputTodo.focus();
    }
}
function firstLoad(){
    listInfo = JSON.parse(localStorage.getItem("todoList"))??{};
    for(let id in listInfo){
        const el = listInfo[id];
        const div = document.createElement("div");
        const li = document.createElement("li");
        div.textContent = el.value;
        div.dataset.time = id;
        div.classList.toggle("checked",el.checked);
        li.append(div)
        ulTodo.append(li);
        addClose(div);
        addEventsDragAndDrop(div);
    }
}
firstLoad();

// bonus :
function dragStart(e) {
    this.style.opacity = '0.4';
    // indique quel type d'évènement est permit par le drag&drop
    e.dataTransfer.effectAllowed = 'move';
    // Permet de sauvegarder une donnée lié au drag&drop
    e.dataTransfer.setData('text', this.dataset.time);
};

function dragEnter(e) {
    this.classList.add('over');
}

function dragLeave(e) {
    // Pour ne pas propager l'évènement aux parents.
    e.stopPropagation();
    this.classList.remove('over');
}

function dragOver(e) {
    // pour désactiver les évènements par défaut d'un drag and drop
    e.preventDefault();
    // Indique l'effet escompté par le drop
    e.dataTransfer.dropEffect = 'move';
    return false;
}

function dragDrop(e) {
    // Récupère une donnée lié sauvegardé au préalable.
    let time = e.dataTransfer.getData('text');
    let dragSrcEl = document.querySelector(`[data-time="${time}"]`)
    if (dragSrcEl != this) {
        // échanger les éléments div dans leurs li.
        let parent = dragSrcEl.parentElement;
        this.parentElement.append(dragSrcEl);
        parent.append(this)
        // échanger les éléments dans l'objet liste'.
        let tmp = listInfo[this.dataset.time];
        listInfo[this.dataset.time] = listInfo[dragSrcEl.dataset.time];
        listInfo[dragSrcEl.dataset.time] = tmp;
        // échange leurs identifiants.
        [this.dataset.time, dragSrcEl.dataset.time] = [dragSrcEl.dataset.time, this.dataset.time]
        // Sauvegarde le nouveau tableau.
        localStorage.setItem("todoList", JSON.stringify(listInfo));
    }
    return false;
}

function dragEnd(e) {
    let listItems = document.querySelectorAll('#todo ul div');
    listItems.forEach(it=>it.classList.remove("over"));
    this.style.opacity = '1';
}

function addEventsDragAndDrop(el) {
    el.draggable = true;
    // début du drag and drop
    el.addEventListener('dragstart', dragStart);
    // quand on entre sur un élément pendant un drag and drop
    el.addEventListener('dragenter', dragEnter);
    // quand on se déplace au dessus d'un élément
    el.addEventListener('dragover', dragOver);
    // quand on quitte un élément
    el.addEventListener('dragleave', dragLeave);
    // quand on lâche notre élément
    el.addEventListener('drop', dragDrop);
    // une fois terminé
    el.addEventListener('dragend', dragEnd);
}