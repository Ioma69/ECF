<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Visitor;
use App\Form\ReservationUserType;
use App\Form\ReservationVisitorType;
use App\Form\VisitorType;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'reservation')]
    public function index4(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Reservation::class);                  
        $reservations = $repository->findAll(); 
        return $this->render('reservation/Reservation.html.twig', [
            'reservations' => $reservations,
        ]);
    }

    #[Route('/userReservation', name: 'userReservation')]
    public function reservationUser(Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->isGranted('ROLE_USER')){
        $reservations = new Reservation();
        $reservationsForm = $this->createForm(ReservationUserType::class, $reservations);
        $reservationsForm->handleRequest($request);

        if ($reservationsForm->isSubmitted() && $reservationsForm->isValid()) {
            $reservations->setUser($this->getUser()); 
            
            // Vérification du nombre de couverts pour l'horaire choisi
            $repository = $doctrine->getRepository(Reservation::class);                  
            $existingReservations = $repository->findBy([
                'reservationDate' => $reservations->getReservationDate(),
                'reservationHour' => $reservations->getReservationHour()
            ]);

            $totalFlatware = 0;
            foreach ($existingReservations as $existingReservation) {
                $totalFlatware += $existingReservation->getFlatware();
            }

            $maxFlatware = 10;
            $availableFlatware = $maxFlatware - $totalFlatware;

            if ($availableFlatware < $reservations->getFlatware()) {
                
                return new JsonResponse(['message' => 'Le nombre de couverts pour cette heure est complet. Veuillez choisir un autre horaire.'], 400);
            }

            $em = $doctrine->getManager();
            $em->persist($reservations);
            $em->flush();
            return new JsonResponse(['message' => 'Réservation effectuée avec succès']);
        };
    
        return $this->render('reservation/FormReservation.html.twig', [
            "reservations" => $reservationsForm->createView()
        ]);
    }
    return $this->redirectToRoute("home");
}
    



#[Route('/makeReservation', name: 'visitorReservation')]
public function reservationVisitor(Request $request, ManagerRegistry $doctrine): Response
{
    $reservations = new Reservation();
    $reservationsForm = $this->createForm(ReservationVisitorType::class, $reservations);
    $reservationsForm->handleRequest($request);
   
    if ($reservationsForm->isSubmitted() && $reservationsForm->isValid()) {
        $reservations->setVisitor($this->getUser()); 
        
        // Vérification du nombre de couverts pour l'horaire choisi
        $repository = $doctrine->getRepository(Reservation::class);                  
        $existingReservations = $repository->findBy([
            'reservationDate' => $reservations->getReservationDate(),
            'reservationHour' => $reservations->getReservationHour()
        ]);

        $totalFlatware = 0;
        foreach ($existingReservations as $existingReservation) {
            $totalFlatware += $existingReservation->getFlatware();
        }

        $maxFlatware = 10;
        $availableFlatware = $maxFlatware - $totalFlatware;

        if ($availableFlatware < $reservations->getFlatware()) {
            
            return new JsonResponse(['message' => 'Le nombre de couverts pour cette heure est complet. Veuillez choisir un autre horaire.'], 400);
        }

        $em = $doctrine->getManager();
        $em->persist($reservations);
        $em->flush();
        return new JsonResponse(['message' => 'Réservation effectuée avec succès']);
    };
    

    return $this->render('reservation/FormReservationVisitor.html.twig', [
        "reservationsVisitor" => $reservationsForm->createView()
    ]);


}


}