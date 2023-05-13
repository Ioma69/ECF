<?php

namespace App\Controller;

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
           // $visitor->setCategory($visitor);
            $em = $doctrine->getManager();
            $em->persist($visitor);
            $em->flush();
            return $this->redirectToRoute("visitorReservation");
        };
        
        return $this->render('visitor/visitor.html.twig', [
            "visitors" => $visitorForm->createView()
        ]);
    
}



}
