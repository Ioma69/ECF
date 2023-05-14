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
    public function dishes(Request $request, ManagerRegistry $doctrine): Response
    {
        
        $visitor = new Visitor();
        $visitorForm = $this->createForm(VisitorType::class, $visitor);
        $visitorForm->handleRequest($request);

        if ($visitorForm->isSubmitted() && $visitorForm->isValid()) { 
            $this->addFlash('valid', 'Vous pouvez maintenant aller au formulaire de réservation');
           // $visitor->setCategory($visitor);
            $em = $doctrine->getManager();
            $em->persist($visitor);
            $em->flush();

            $visitorId = intval($visitor->getId());
        return $this->redirectToRoute('visitorReservation', ['visitorId' => $visitorId]); // envoie l'id dans le controlleur qui gere la réservation
          
        };
        
        return $this->render('visitor/visitor.html.twig', [
            "visitors" => $visitorForm->createView()
        ]);
    
}



}
