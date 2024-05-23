<?php 
/* 
    PHPMailer est la bibliothèque d'envoi de mail la plus populaire chez php.
    Elle peut s'installer avec composer via :
        * composer require phpmailer/phpmailer
*/
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/../../vendor/autoload.php";

/**
 * Envoi un mail
 *
 * @param string $from
 * @param string $to
 * @param string $subject
 * @param string $body
 * @return string
 */
function sendMail(string $from, string $to, string $subject, string $body): string
{
    /* 
        On crée un nouvel objet PHPMailer,
        L'argument à true permet d'activer les exceptions (type d'erreur)
    */
    $mail = new PHPMailer(true);
    try
    {
        /* 
            On active l'utilisation de SMTP
            (Simple Mail Transfer Protocol)
        */
        $mail->isSMTP();
        /* 
            On indique où est hebergé le serveur de mail :
        */
        $mail->Host = "sandbox.smtp.mailtrap.io";
        /* 
            On active l'authentification par SMTP
        */
        $mail->SMTPAuth = true;
        /* 
            On indique le port du serveur de mail :
        */
        $mail->Port = 2525;
        /* 
            On indique les identifiants du serveur de mail
        */
        $mail->Username = "1e77adf0ab1df0";
        $mail->Password = "5779de4e98bd51";
        /* 
            Permet de donner de nombreux détail sur le déroulement de la requête.
        */
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        /* 
            Quel type de chiffrement sera utilisé pour envoyer les mails.
        */
        // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        /* 
            Indique l'expediteur du mail
        */
        $mail->setFrom($from);
        /* 
            Permet d'ajouter une adresse mail auquel envoyer l'email.
        */
        $mail->addAddress($to);
        /* 
            On trouvera aussi :
                - addReplyTo
                - addCC
                - addBCC
                - addAttachment

            Indique que le format du mail est en HTML
        */
        $mail->isHTML(true);
        /* 
            Indique le sujet du mail
        */
        $mail->Subject = $subject;
        /* 
            Indique le corps de l'email (le message)
        */
        $mail->Body = $body;
        /* 
            On peut aussi ajouter un "AltBody" dans le cas où le gestionnaire de mail ne gère pas le HTML.

            Envoi le mail
        */
        $mail->send();
        return "message envoyé";
    }catch(Exception $e)
    {
        return "Le message n'a pas pu être envoyé. Mailer Error :{$mail->ErrorInfo}";
    }
}
?>