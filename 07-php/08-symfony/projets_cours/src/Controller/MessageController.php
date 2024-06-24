<?php

namespace App\Controller;

use App\Entity\Message;
use App\Repository\MessageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/message")]
class MessageController extends AbstractController
{

    #[Route("/{page<\d+>?1}/{nb<\d+>?5}", name: "app_message_read")]
    // public function readMessage(ManagerRegistry $doc): Response
    public function readMessage(MessageRepository $repo, $page, $nb): Response
    {
        // $repo = $doc->getRepository(Message::class);
        // $messages = $repo->findAll();
        // $messages = $repo->findBy([], ["createdAt"=>"DESC"]);
        $messages = $repo->findBy([], ["createdAt"=>"DESC"], $nb, ($page-1)*$nb);
        $total = $repo->count();
        $nbPage = ceil($total/$nb);
        return $this->render("message/index.html.twig", [
            "messages"=> $messages,
            "nbPage"=>$nbPage,
            "nombre"=>$nb,
            "currentPage"=>$page
        ]);
    }

    #[Route('/add', name: 'app_message_create')]
    public function createMessage(ManagerRegistry $doc): Response
    {
        $em = $doc->getManager();
        $message = new Message();
        $message->setContent("Ceci est un message de test")
                ->setCreatedAt(new \DateTimeImmutable());

        $em->persist($message);

        $message2 = new Message();
        $message2->setContent("Ceci est un second message de test")
                ->setCreatedAt(new \DateTimeImmutable());
        $em->persist($message2);
        $em->flush();

        return $this->render('message/index.html.twig', [
            'controller_name' => 'MessageController',
        ]);
    }

    #[Route("/delete/{id<\d+>}", name: "app_message_delete")]
    public function deleteMessage(ManagerRegistry $doc, $id): Response
    {
        $repo = $doc->getRepository(Message::class);
        $message = $repo->find($id);
        if(!$message)
        {
            $this->addFlash("error", "Aucun message correspondant");
        }
        else
        {
            // dd($message);
            $em = $doc->getManager();
            $em->remove($message);
            $em->flush();
            $this->addFlash("info", "Message Supprimé");
        }
        return $this->redirectToRoute("app_message_read");
    }
    #[Route("/update/{id<\d+>}", name: "app_message_update")]
    public function updateMessage(Message $message=null): Response
    {
        if(!$message)
        {
            $this->addFlash("error", "Aucun message correspondant");
        }
        else
        {
            dd($message);
        }
        return $this->redirectToRoute("app_message_read");
    }
}
