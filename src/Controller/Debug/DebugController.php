<?php

namespace App\Controller\Debug;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class DebugController extends AbstractController
{
    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new TemplatedEmail())
            ->from('cinemasymfony@gmail.com')
            ->to('cinemasymfony@gmail.com')
            ->subject('Time for Symfony Mailer!')
            ->htmlTemplate('email/test.html.twig')
            ->context([
                'message' => 'dupa'
            ]);

        $mailer->send($email);

        return new Response('dziala');
    }
}
