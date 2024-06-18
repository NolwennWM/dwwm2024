<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

// #[Route("/truc")]
class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            "fruits"=>["banane", "tomate", "cerise"],
            "pays"=>["france"=>"Bonjour le monde !", "angleterre"=>"Hello World !"],
            "chiffre"=>rand(0, 10),
            "vide"=>[],
            "xss"=>"<script>alert('coucou');</script>",
            "title"=>"chaussette"
        ]);
    }


    // #[Route("/bonjour/anglais/{username}", name:"app_hello")]
    // #[Route("/bonjour/anglais/{username}", name:"app_hello", defaults:["username"=>"John"])]
    #[Route("/bonjour/anglais/{username}", 
        name:"app_hello", 
        defaults:["username"=>"John"], 
        requirements:["username"=>"^[a-zA-Z]+$"])]
    public function hello($username): RedirectResponse
    {
        // dd("Hello ".$username);
        $this->addFlash("info", "Hello $username");
        $this->addFlash("info", "Vous avez été redirigé");
        return $this->redirectToRoute("app_bonjour", ["nom"=>"Doe", "prenom"=>"username"]);
    }
    // #[Route("/bonjour/{nom}/{prenom}", name: "app_bonjour")]
    // #[Route("/bonjour/{nom}/{prenom?Jean}", name: "app_bonjour")]
    #[Route("/bonjour/{nom<^[a-zA-Z]+$>}/{prenom<^[a-zA-Z]+$>?Jean}", name: "app_bonjour")]
    public function bonjour($nom, $prenom, Request $request): Response
    {
        dump($nom, $prenom, $request);
        // dd($request);
        $sess = $request->getSession();

        if($sess->has("nbVisite"))
        {
            $nb = $sess->get("nbVisite")+1;
        }
        else
        {
            $nb = 1;
        }
        $sess->set("nbVisite", $nb);

        $this->addFlash("info", "Bonjour $prenom $nom");
        return $this->render("home/bonjour.html.twig",[
            "nom"=>$nom,
            "prenom"=>$prenom
        ]);
    }
}
