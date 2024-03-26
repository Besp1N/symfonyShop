<?php

namespace App\Services;

use App\Entity\Cart;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class RegistrationService
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly UserPasswordHasherInterface $userPasswordHasher,
        private readonly EmailSenderService $emailSenderService
    )
    {
    }

    /**
     * @throws TransportExceptionInterface
     */
    public function registerUser(User $user, $form): void
    {
        $cart = new Cart();
        $user->setPassword($this->userPasswordHasher->hashPassword($user, $form->get('plainPassword')->getData()));
        $user->setRoles(['ROLE_USER']); // by default role user
        $user->setIsActive(false);
        $user->setActivationKey(md5(uniqid()));
        $cart->setUser($user);
        $cart->setTotal(0.00);

        // During the registration, cart is auto created
        $this->entityManager->persist($cart);
        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $this->emailSenderService->sendEmail($user);
    }
}