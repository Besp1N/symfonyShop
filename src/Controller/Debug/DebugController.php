<?php

namespace App\Controller\Debug;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class DebugController extends AbstractController
{
    #[Route('/debug', name: 'app_debug')]
    public function index(): Response
    {
        $transport = Transport::fromDsn('smtp://cinemasymfony@gmail.com:yxszxjbnjvhyumvg@smtp.gmail.com:587');

        $mailer = new Mailer($transport);

        $email = (new Email());

        $email->from('cinemasymfony@gmail.com');

        $email->to('cinemasymfony@gmail.com');

        $email->subject('Test');

        $email->text('Test');

        $email->html('<h1> elo </h1>');

        $mailer->send($email);

        return new Response('dupa');
    }
}
