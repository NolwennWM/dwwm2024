<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/todo')]
class ToDoController extends AbstractController
{
    #[Route('/add/{name}/{content}', name: 'todo.add')]
    public function create($name, $content, Request $req): RedirectResponse
    {
        $s = $req->getSession();
        if($s->has("todolist"))
        {
            $todo = $s->get("todolist");
            if(isset($todo[$name])) $this->addFlash("danger", "Cette tâche existe déjà");
            else
            {
                $todo[$name] = $content;
                $s->set("todolist", $todo);
                $this->addFlash("success", "La tâche $name a bien été ajouté");
            } 
        }
        else $this->addFlash("danger", "todolist non initialisé");
        return $this->redirectToRoute("todo.read");
    }
    #[Route('/', name: 'todo.read')]
    public function read(Request $req): Response
    {
        $s = $req->getSession();
        if(!$s->has("todolist"))
        {
            $s->set("todolist", []);
            $this->addFlash("success", "La todo list vient d'être initialisé.");
        }
        return $this->render('to_do/index.html.twig');
    }
    #[Route('/update/{name}/{content}', name: 'todo.update')]
    public function update($name, $content, Request $req): RedirectResponse
    {
        $s = $req->getSession();
        if($s->has("todolist"))
        {
            $todo = $s->get("todolist");
            if(isset($todo[$name]))
            {
                $todo[$name] = $content;
                $s->set("todolist", $todo);
                $this->addFlash("success", "La tâche $name a bien été mis à jour");
            } 
            else $this->addFlash("danger", "Cette tâche n'existe pas");
        }
        else $this->addFlash("danger", "todolist non initialisé");

        return $this->redirectToRoute("todo.read");
    }
    #[Route('/delete/{name}', name: 'todo.delete')]
    public function delete($name, Request $req): RedirectResponse
    {
        $s = $req->getSession();
        if($s->has("todolist"))
        {
            $todo = $s->get("todolist");
            if(isset($todo[$name]))
            {
                unset($todo[$name]);
                $s->set("todolist", $todo);
                $this->addFlash("warning", "La tâche $name vient d'être supprimé");
            }
            else $this->addFlash("danger", "Cette tâche n'existe pas.");
        }
        else $this->addFlash("danger", "todolist non initialisé");
        return $this->redirectToRoute("todo.read");
    }
    #[Route('/reset', name: 'todo.reset')]
    public function reset(Request $req): RedirectResponse
    {
        $s = $req->getSession();
        if($s->has("todolist"))
        {
            $s->remove("todolist");
            $this->addFlash("warning", "todolist reset");
        }
        else $this->addFlash("danger", "todolist non initialisé");
        return $this->redirectToRoute("todo.read");
    }
}
