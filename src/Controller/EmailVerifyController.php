<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmailVerifyController extends AbstractController
{
    #[Route('/email/{token}', name: 'app_email_verify')]
    public function index(string $token, UserRepository $userRepository): Response
    {
        $user = $userRepository->find(['activation_key' => $token]);

        if (!$user) {
            return new Response('Not Found');
        }

        $user->setIsActive(true);
        $this->addFlash('success', 'You have verifed your email!');

        return $this->redirectToRoute('app_login');


    }
}
