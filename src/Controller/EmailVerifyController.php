<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmailVerifyController extends AbstractController
{
    #[Route('/email/{token}', name: 'app_email_verify')]
    public function index(
        string $token,
        UserRepository $userRepository,
        EntityManagerInterface $entityManager
    ): Response
    {
        $user = $userRepository->findOneBy(['activationKey' => $token]);

        if (!$user) {
            return new Response('Not Found');
        }

        $user->setIsActive(true);
        $entityManager->persist($user);
        $entityManager->flush();













































        $this->addFlash('success', 'You have verifed your email!');

        return $this->redirectToRoute('app_login');


    }
}
