<?php

namespace App\Controller;

use App\Entity\Categories;
use App\Entity\Dishes;
use App\Entity\Menu;
use App\Form\DishesType;
use App\Form\MenuType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenusController extends AbstractController
{

    #[Route('/formula', name:"formula")]
    public function index(ManagerRegistry $doctrine): Response 
    {
        $repository = $doctrine->getRepository(Menu::class);           
        $menus = $repository->findAll(); 
        return $this->render('dishes/Formula.html.twig', [                 
            "menus" => $menus
        ]);
    }





#[Route('/menu/upload', name: 'addMenu')]
    public function menu(Request $request, ManagerRegistry $doctrine): Response
    {
        $menus = new Menu();
        $dishesForm = $this->createForm(MenuType::class, $menus);
        $dishesForm->handleRequest($request);
        if ($dishesForm->isSubmitted() && $dishesForm->isValid()) { 
            $menus->SetAdminMenu($this->getUser()); 
            // mettre le nom des plats
            $em = $doctrine->getManager();
            $em->persist($menus);
            $em->flush();
            return $this->redirectToRoute("formula");
        }
        return $this->render('dishes/FormFormula.html.twig', [
            "menus" => $dishesForm->createView()
        ]);
    }
}