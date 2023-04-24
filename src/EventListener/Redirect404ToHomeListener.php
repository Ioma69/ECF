<?php

namespace App\EventListener;

use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\RouterInterface;

class Redirect404ToHomeListener
{
    private $router;
    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        // Si l'evenement recoit une exception de type not found alors on sort
        if (!$event->getThrowable() instanceof NotFoundHttpException) {
            return;
        }
        // On cree une reponse qui nous redirige vers la page d'accueil
        $response = new RedirectResponse($this->router->generate('home'));
        // met a jour la réponse
        $event->setResponse($response);
    }
}