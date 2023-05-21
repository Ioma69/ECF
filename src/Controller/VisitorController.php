<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Visitor;
use App\Form\VisitorType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VisitorController extends AbstractController
{


    #[Route('/visitor/info', name: 'addInfo')]
    public function addInfo(Request $request, ManagerRegistry $doctrine): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            $visitor = new Visitor();
            $visitorForm = $this->createForm(VisitorType::class, $visitor);
            $visitorForm->handleRequest($request);
            $isFormSubmitted = false;

            if ($visitorForm->isSubmitted() && $visitorForm->isValid()) {
                $isFormSubmitted = true;
                $em = $doctrine->getManager();
                $em->persist($visitor);
                $em->flush();

                $visitorId = intval($visitor->getId());
                $this->addFlash('valid', 'Vous allez maintenant etre rédirigé vers le formulaire de réservation');
                echo "<script>setTimeout(function() {
                window.location.href = '" . $this->generateUrl('visitorReservation', ['visitorId' => $visitorId]) . "';
            }, 3000);</script>"; // envoie l'id dans le controlleur qui gere la réservation
                return $this->render('visitor/visitor.html.twig', [
                    'visitors' => $visitorForm->createView(),
                    'isFormSubmitted' => $isFormSubmitted
                ]);
            }



            return $this->render('visitor/visitor.html.twig', [
                "visitors" => $visitorForm->createView(),
                'isFormSubmitted' => $isFormSubmitted

            ]);
        }
        return $this->redirectToRoute('home');

    }



}