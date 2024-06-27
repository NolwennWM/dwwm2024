<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use App\Service\Uploader;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route("/message")]
class MessageController extends AbstractController
{
    public function __construct(private Uploader $uploader)
    {}

    #[Route("/{page<\d+>?1}/{nb<\d+>?5}", name: "app_message_read")]
    // public function readMessage(ManagerRegistry $doc): Response
    public function readMessage(MessageRepository $repo, $page, $nb): Response
    {
        // $repo = $doc->getRepository(Message::class);
        // $messages = $repo->findAll();
        // $messages = $repo->findBy([], ["createdAt"=>"DESC"]);
        $messages = $repo->findBy([], ["createdAt"=>"DESC"], $nb, ($page-1)*$nb);
        $total = $repo->count();
        // $messages = $repo->findByDateInterval("2022-06-01", "2024-06-01");
        // $total = count($messages);
        $nbPage = ceil($total/$nb);
        return $this->render("message/index.html.twig", [
            "messages"=> $messages,
            "nbPage"=>$nbPage,
            "nombre"=>$nb,
            "currentPage"=>$page
        ]);
    }

    #[Route('/add', name: 'app_message_create')]
    public function createMessage(ManagerRegistry $doc, Request $request): Response
    {
        /* 
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
        */
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $image = $form->get("imageFile")->getData();
            if($image)
            {
                $dir = $this->getParameter("message_directory");
                $message->setImage($this->uploader->uploadFile($image, $dir));
            }
            $em = $doc->getManager();
            $em->persist($message);
            $em->flush();

            $this->addFlash("success", "Un nouveau message a bien été ajouté");
            return $this->redirectToRoute("app_message_read");
        }
        return $this->render('message/create.html.twig', [
            'messageForm' => $form,
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
            $dir = $this->getParameter("message_directory");
            $img = $message->getImage();
            if($img)
            {
                unlink($dir."/".$img);
            }
            $em = $doc->getManager();
            $em->remove($message);
            $em->flush();
            $this->addFlash("info", "Message Supprimé");
        }
        return $this->redirectToRoute("app_message_read");
    }
    #[Route("/update/{id<\d+>}", name: "app_message_update")]
    public function updateMessage(Message $message=null, ManagerRegistry $doc, Request $request): Response
    {
        if(!$message)
        {
            $this->addFlash("error", "Aucun message correspondant");
            return $this->redirectToRoute("app_message_read");
        }
        /* 
            else
            {
                // dd($message);
                $message->setContent($content)
                        ->setEditedAt(new \DateTime());
                $em = $doc->getManager();
                $em->persist($message);
                $em->flush();

                $this->addFlash("info", "Message mis à jour");
            }
            return $this->redirectToRoute("app_message_read"); 
        */
        
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $image = $form->get("imageFile")->getData();
            if($image)
            {
                $oldImage = $message->getImage();
                $dir = $this->getParameter("message_directory");
                $message->setImage($this->uploader->uploadFile($image, $dir));
                if($oldImage)
                {
                    unlink($dir."/".$oldImage);
                }
            }
            $em = $doc->getManager();
            $em->persist($message);
            $em->flush();

            $this->addFlash("success", "message mis à jour");
            return $this->redirectToRoute("app_message_read");
        }
        return $this->render('message/create.html.twig', [
            'messageForm' => $form,
        ]);
    }
}
