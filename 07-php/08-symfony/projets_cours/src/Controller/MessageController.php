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

    #[Route("/", name: "app_message_read")]
    // public function readMessage(ManagerRegistry $doc): Response
    public function readMessage(MessageRepository $repo): Response
    {
        // $repo = $doc->getRepository(Message::class);
        $messages = $repo->findAll();
        return $this->render("message/index.html.twig", [
            "messages"=> $messages
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
}
