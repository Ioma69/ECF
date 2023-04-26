<?php

namespace App\Controller;

use App\Entity\Dishes;
use App\Form\DishesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishesController extends AbstractController
{

    #[Route('/menu', name:"menu")]
    public function index(ManagerRegistry $doctrine): Response 
    {
        $repository = $doctrine->getRepository(Dishes::class);           // Récupération du repository de l'entité "Dishes"
        $dishes = $repository->findAll(); // SELECT * FROM 'Dishes';  // Stocke toutes les photos dans la variable $picdishes
        dump($dishes);
        return $this->render('dishes/Menu.html.twig', [                 // Envoie le tableau des photos au template Twig
            "dishes" => $dishes
        ]);
    }



    #[Route('/menu/upload', name: 'menuAdmin')]
    public function menu(Request $request, ManagerRegistry $doctrine): Response
    {
        $dishes = new Dishes();
        $dishesForm = $this->createForm(DishesType::class, $dishes);
        $dishesForm->handleRequest($request);
        if ($dishesForm->isSubmitted() && $dishesForm->isValid()) { 
            $em = $doctrine->getManager();
            $em->persist($dishes);
            $em->flush();
            return $this->redirectToRoute("menu");
        }
        return $this->render('dishes/FormMenu.html.twig', [
            "dishes" => $dishesForm->createView()
        ]);
    }


    #[Route('/menu/delete/{id<\d+>}', name:"delete-menu")]
    public function deleteMenu(Dishes $dishes, ManagerRegistry $doctrine): Response    
    {
        $em = $doctrine->getManager();
        $em->remove($dishes);
        $em->flush(); 
        return $this->redirectToRoute("menu");
    }


    #[Route('/menu/edit/{id<\d+>}', name:"edit-menu")]
    public function updateMenu(Request $request, Dishes $dishes, ManagerRegistry $doctrine): Response    
    {
        $dishesForm = $this->createForm(DishesType::class, $dishes);
        $dishesForm->handleRequest($request);
        if ($dishesForm->isSubmitted() && $dishesForm->isValid() ) {
            $em = $doctrine->getManager();                 
            $em->persist($dishes);       
            $em->flush(); 
            return $this->redirectToRoute("menu");
        }

        return $this->render('dishes/FormMenu.html.twig', [
            "dishes" => $dishesForm->createView()
        ]);
        
    }


}
