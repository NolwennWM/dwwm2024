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
   5. afficher la liste sauvegardé au chargement de la page.
   6. éditer la liste lorsque l'on coche ou supprime un élément.
   Bonus : Utiliser le drag and drop pour déplacer nos éléments dans la liste. il faudra penser à sauvegarder les éléments déplacé.
 */
document.addEventListener('DOMContentLoaded', function(){
   const taskInput = document.getElementById("taskInput");
   const addTaskBtn = document.getElementById("addTaskBtn");
   const taskList = document.getElementById("taskList");

   loadTask();
   addTaskBtn.addEventListener("click", function(){
      const taskText = taskInput.value.trim();
      if(taskText !== "")
      {
         addTask(taskText);
         saveTask();
         taskInput.value = "";
      }
   });
});

function addTask(taskText, completed = false)
{
   const taskItem = document.createElement("li");
   taskItem.classList.add("task");
   if(completed)
   {
      taskItem.classList.add("completed");
   }
   taskItem.innerHTML = 
   `<span class="taskText">${taskText}</span>
   <button class="deleteBtn">X</button>`;
   taskItem.querySelector(".taskText").addEventListener("click", function(){
      taskItem.classList.toggle("completed");
      saveTask();
   });
   taskItem.querySelector(".deleteBtn").addEventListener("click", function(){
      taskItem.remove();
      saveTask();
   });
   taskList.appendChild(taskItem);
}

function loadTask()
{
   const task = JSON.parse(localStorage.getItem("task"));
   if(task)
   {
      task.forEach(task => {addTask(task.text, task.completed)})
   }
}

function saveTask()
{
   const task = [];
   document.querySelectorAll("#taskList .task").forEach(taskItem=>{
      task.push({text: taskItem.querySelector(".taskText").innerText, completed: taskItem.classList.contains("completed")})
   });
   localStorage.setItem("task", JSON.stringify(task));
}