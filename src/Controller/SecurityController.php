<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Form\LoginType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'login')]
    public function login(ManagerRegistry $doctrine, AuthenticationUtils $authenticationUtils, Request $request,\Twig\Environment $twig): Response           // Injection de la dependance authenticationutils
    {
        $error = $authenticationUtils->getLastAuthenticationError();        // s'il y a une erreur de connexion, la stocke dans la variable '$error'
        $lastUsername = $authenticationUtils->getLastUsername();            // Stocke le dernier nom d'utilisateur saisie dans une variable '$lastUserName'
        

        $form = $this->createForm(LoginType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

        }


        return $this->render('security/login.html.twig', [
            'error' => $error,
            'last_username' => $lastUsername,
            "form" => $form->createView(),
        ]);
    }


    #[Route('/logout', name: 'logout')]
    public function logout()
    {
    }
}
