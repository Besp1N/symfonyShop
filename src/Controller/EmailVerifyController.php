<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Services\EmailActivationService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class EmailVerifyController extends AbstractController
{
    /*
     * This function is to verify user by token in link
     */
    #[Route('/email/{token}', name: 'app_email_verify')]
    public function index(
        string $token,
        EmailActivationService $emailActivationService
    ): Response
    {
        $emailActivationService->activeUser($token);

        $this->addFlash('success', 'You have verified your email!');
        return $this->redirectToRoute('app_login');


    }
}
