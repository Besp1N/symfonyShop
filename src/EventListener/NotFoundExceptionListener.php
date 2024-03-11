<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class NotFoundExceptionListener implements EventSubscriberInterface
{
    private Environment $twig;

    public function __construct(Environment $twig)
{
    $this->twig = $twig;
}

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function onKernelException(ExceptionEvent $event): void
    {
    $exception = $event->getThrowable();

    if ($exception instanceof NotFoundHttpException) {
        $response = new Response(
            $this->twig->render('error/error404.html.twig'),
            Response::HTTP_NOT_FOUND
        );

        $event->setResponse($response);
    }
}

    public static function getSubscribedEvents(): array
    {
    return [
        KernelEvents::EXCEPTION => 'onKernelException',
    ];
}
}
