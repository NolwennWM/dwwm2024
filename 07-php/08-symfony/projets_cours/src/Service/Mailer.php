<?php 
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class Mailer
{
    public function __construct(private MailerInterface $mailer)
    {}

    public function sendMail(
        string $from = "noreply@cours.fr", 
        string $to = "user@cours.fr", 
        string $subject = "Message Automatique",
        string $content = "Ne pas répondre à ce message."
        ):void
    {
        $email = (new Email())
            ->from($from)
            ->to($to)
            ->subject($subject)
            ->html($content);
        $this->mailer->send($email);
    }
}
?>