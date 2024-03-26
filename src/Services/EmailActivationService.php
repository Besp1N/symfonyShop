<?php

namespace App\Services;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class EmailActivationService
{
    public function __construct(
        private UserRepository         $userRepository,
        private EntityManagerInterface $entityManager
    )
    {}

    /*
     * This function activates user if the activationKey is correct
     * otherwise it throws new 404 exception
     */
    public function activeUser(string $token): void
    {
        $user = $this->userRepository->findOneBy(['activationKey' => $token]);

        if (!$user) {
            throw new NotFoundHttpException('User not found');
        }

        $user->setIsActive(true);
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}