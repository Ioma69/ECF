<?php

namespace App\Controller;

use App\Entity\PicDishes;
use App\Form\PicDishesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class Controller extends AbstractController
{
    #[Route('/')]
    public function index(ManagerRegistry $doctrine): Response 
    {
        $repository = $doctrine->getRepository(PicDishes::class);           // Récupération du repository de l'entité "PicDishes"
        $picdishes = $repository->findAll(); // SELECT * FROM 'picDishes';  // Stocke toutes les photos dans la variable $picdishes
        return $this->render('PicDishes/index.html.twig', [                 // Envoie le tableau des photos au template Twig
            "picdishes" => $picdishes
        ]);
    }

    #[Route('/Picdishes/upload')]
    public function upload(Request $request, ManagerRegistry $doctrine): Response    // Injection de l'objet ManagerRegistry
    {
        $picdishes = new PicDishes();
        $form = $this->createForm(PicDishesType::class, $picdishes);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() ) {
            $em = $doctrine->getManager();                  // Recuperation d'un instance d'entity manager
            $em->persist($picdishes);   // Ajout de l'objet $picdishes à l'EM        
            $em->flush(); // Synchronisation de l'object ajouté à l'Em avec le BDD
        }

        return $this->render('PicDishes/PicDishes.html.twig', [
            "picdishes_form" => $form->createView()
        ]);
        
    }
}
