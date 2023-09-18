<?php

namespace App\Controller;


use App\Form\LoginType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request, CsrfTokenManagerInterface $csrfTokenManager): Response // Injection de la dependance authenticationutils
    {
        $error = $authenticationUtils->getLastAuthenticationError(); // s'il y a une erreur de connexion, la stocke dans la variable '$error'
        $lastUsername = $authenticationUtils->getLastUsername(); // Stocke le dernier nom d'utilisateur saisie dans une variable '$lastUserName'


        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $token = $request->request->get('_token');
            if (!$csrfTokenManager->isTokenValid(new CsrfToken('authenticate', $token))) {
                throw new \Exception('Jeton CSRF invalide.');
            }
        }


        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }


    #[Route('/logout', name: 'logout')]
    public function logout()
    {
    }
}