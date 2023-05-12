<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Dishes;
use App\Entity\Menu;
use App\Entity\Schedule;
use App\Form\DishesType;
use App\Form\MenuType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishesController extends AbstractController
{

    #[Route('/menu', name:"menu")]
    public function index2(ManagerRegistry $doctrine,\Twig\Environment $twig): Response 
    {
        $repository = $doctrine->getRepository(Dishes::class);           // Récupération du repository de l'entité "Dishes"
        $dishes = $repository->findAll(); // SELECT * FROM 'Dishes';  // Stocke toutes les photos dans la variable $picdishes
        $repository = $doctrine->getRepository(Schedule::class);           
        $schedules = $repository->findAll(); 
        return $this->render('dishes/menu.html.twig', [                 // Envoie le tableau des photos au template Twig
            "dishes" => $dishes,
            $twig->addGlobal("schedules",$schedules),
        ]);
    }



    #[Route('/dishes/upload', name: 'addDishes')]
    public function dishes(Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->isGranted('ROLE_ADMIN')){
        $dishes = new Dishes();
        $categories = new Categories();
        $dishesForm = $this->createForm(DishesType::class, $dishes);
        $dishesForm->handleRequest($request);
        if ($dishesForm->isSubmitted() && $dishesForm->isValid()) { 
            $categories->setName($dishesForm->get('categories')->getData());
            $dishes->setAdmin($this->getUser()); 
            $dishes->setCategory($categories);
            $em = $doctrine->getManager();
            $em->persist($dishes);
            $em->persist($categories);
            $em->flush();
            return $this->redirectToRoute("menu");
        };
        
        return $this->render('dishes/FormMenu.html.twig', [
            "dishes" => $dishesForm->createView()
        ]);
    
    }
    return $this->redirectToRoute("home");
}


 


    #[Route('/dishes/delete/{id<\d+>}', name:"delete-dishes")]
    public function deleteDishes(Dishes $dishes, ManagerRegistry $doctrine): Response    
    {
        if ($this->isGranted('ROLE_ADMIN')){
        $em = $doctrine->getManager();
        $em->remove($dishes);
        $em->flush(); 
        return $this->redirectToRoute("menu");
    }
    return $this->redirectToRoute("home");
}


    #[Route('/dishes/edit/{id<\d+>}', name:"edit-dishes")]
    public function updateDishes(Request $request, Dishes $dishes, ManagerRegistry $doctrine): Response    
    {
        if ($this->isGranted('ROLE_ADMIN')){
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
        return $this->redirectToRoute("home");
    }


}
