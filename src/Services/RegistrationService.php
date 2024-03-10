<?php

namespace App\Services;

use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class RegistrationService
{
    function sendEmail(): void
    {
        $dsn = 'smtp://cinemasymfony@gmail.com:yxszxjbnjvhyumvg@smtp.gmail.com:587';
        $transport = Transport::fromDsn($dsn);
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from('cinemasymfony@gmail.com')
            ->to('cinemasymfony@gmail.com')
            ->subject('Test email')
            ->text('This is a test email.');

        $mailer->send($email);
    }
}



