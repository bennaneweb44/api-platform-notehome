<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EmailController extends AbstractController
{
    /**
     * @Route("/email/send", methods={"POST"})
     */
    public function send(Request $request, LoggerInterface $logger): Response
    {
        // Authorization
        $authorization = $request->headers->get('Authorization');
        $emailAppKey = $this->getParameter('app.email_app_key');

        if (!$authorization || $authorization != 'Bearer ' . $emailAppKey) {
            $logger->error('authorization : ' . $authorization . 
                         ' || emailAppKey : ' . $emailAppKey)
                    ;

            return new Response('Une erreur interne est survenue !',  Response::HTTP_INTERNAL_SERVER_ERROR,
                ['content-type' => 'application/json']);
        }

        // Data
        $data = json_decode($request->getContent(), true);

        $nom = $data['nom'];
        $telephone = $data['telephone'];
        $email = $data['email'];
        $message = $data['message'];

        // Validation
        if (
            !$nom || trim($nom) === '' || 
            !$telephone || trim($telephone) === '' || !is_numeric($telephone) ||
            !$email || trim($email) === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) ||
            !$message || trim($message) === ''
        ) {
            $logger->error('Nom : ' . $nom . 
                        ' || Téléphone : ' . $telephone . 
                        ' || Email : ' . $email . 
                        ' || Message : ' . $message)
                    ;

            return new Response('Une erreur interne est survenue !',  Response::HTTP_INTERNAL_SERVER_ERROR,
                ['content-type' => 'application/json']);
        }

        // Send email
        $mail = new PHPMailer(true);

        try {
            // Server settings
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = $this->getParameter('app.smtp_host');
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->getParameter('app.smtp_username');
            $mail->Password   = $this->getParameter('app.smtp_password');
            $mail->SMTPSecure = 'ssl';
            $mail->Port       = 465;

            // Recipients
            $mail->setFrom($email, 'Contact BW');
            $mail->addAddress($this->getParameter('app.email_to_address'), 'Bennane Web');

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Contact BBW';
            $mail->Body = '<i>Nom : </i>' . $nom . '<br />' .
                        '<i>Téléphone : </i>' . $telephone . '<br/>' .
                        '<i>Email : </i>' . $email . '<br/>' .
                        '<i>Message : </i>' . $message
            ;

            $mail->send();
        } catch (Exception $e) {
            return new Response('Une erreur interne est survenue !',  Response::HTTP_INTERNAL_SERVER_ERROR,
                ['content-type' => 'application/json']);
        }

        return new Response('Demande reçue. Je vous contacterai bientôt !',  Response::HTTP_OK  ,
                    ['content-type' => 'application/json']);
    }
}
