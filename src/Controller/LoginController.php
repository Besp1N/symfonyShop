<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login', priority: 2)]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        /*
         * If authenticated user wants to request for
         * login page, he will be redirected to home route
         */
        if($this->getUser()) {
            return $this->redirect('/');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        return $this->render('login/index.html.twig', ["error" => $error]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {

    }
}
