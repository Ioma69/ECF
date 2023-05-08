<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\ReservationUserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'reservation')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Reservation::class);                  
        $reservations = $repository->findAll(); 
        return $this->render('reservation/Reservation.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/makeReservation', name: 'makeReservation')]
    public function reservation(Request $request, ManagerRegistry $doctrine): Response
    {
        $reservations = new Reservation();
        $reservationsForm = $this->createForm(ReservationUserType::class, $reservations);
        $reservationsForm->handleRequest($request);
        if ($reservationsForm->isSubmitted() && $reservationsForm->isValid()) {
            $reservations->setUser($this->getUser()); 
            $em = $doctrine->getManager();
            $em->persist($reservations);
            $em->flush();
            return $this->redirectToRoute("reservation");
        };
        
        return $this->render('reservation/FormReservation.html.twig', [
            "reservations" => $reservationsForm->createView()
        ]);

}

}