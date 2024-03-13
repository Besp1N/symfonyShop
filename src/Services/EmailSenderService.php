<?php

namespace App\Services;

use App\Entity\User;
use PharIo\Manifest\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

readonly class EmailSenderService
{
    public function __construct(private MailerInterface $mailer)
    {}

    /**
     * @throws TransportExceptionInterface
     */
    public function sendEmail(User $user): void
    {
        $userMail = $user->getEmail();
        $userActivationKey = $user->getActivationKey();

        $email = (new TemplatedEmail())
            ->from('cinemasymfony@gmail.com')
            ->to('cinemasymfony@gmail.com')
            ->htmlTemplate('email/test.html.twig')
            ->context([
               'activation_key' => $userActivationKey
            ]);

        $this->mailer->send($email);
    }
}