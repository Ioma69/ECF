<?php

namespace App\Controller;

use App\Entity\Dishes;
use App\Entity\Menu;
use App\Entity\Schedule;
use App\Form\MenuType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenusController extends AbstractController
{

    #[Route('/formula', name: "formula")]
    public function index3(ManagerRegistry $doctrine, \Twig\Environment $twig): Response
    {
        $repository = $doctrine->getRepository(Menu::class);
        $menus = $repository->findAll();
        $repository = $doctrine->getRepository(Dishes::class);
        $menuDishes = $repository->findAll();
        $repository = $doctrine->getRepository(Schedule::class);
        $schedules = $repository->findAll();

        $menuDishes = [];
        foreach ($menus as $menu) {
            $menuDishes[$menu->getId()] = $menu->getMeal();
        }
        return $this->render('Formulas/Formula.html.twig', [
            "menus" => $menus,
            "menuDishes" => $menuDishes,
            $twig->addGlobal("schedules", $schedules),
        ]);
    }





    #[Route('/menu/upload', name: 'addMenu')]
    public function menu(Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $menus = new Menu();
            $menuForm = $this->createForm(MenuType::class, $menus);
            $menuForm->handleRequest($request);

            if ($menuForm->isSubmitted() && $menuForm->isValid()) {
                $selectedDishes = $menuForm->get('title')->getData(); // Récupérer les plats sélectionnés

                $menus->setAdminMenu($this->getUser());

                foreach ($selectedDishes as $selectedDish) {
                    $menus->addMeal($selectedDish);
                }

                $em = $doctrine->getManager();
                $em->persist($menus);
                $em->flush();

                return $this->redirectToRoute("formula");
            }

            return $this->render('Formulas/FormFormula.html.twig', [
                "menus" => $menuForm->createView()
            ]);
        }

        return $this->redirectToRoute("formula");
    }



    #[Route('/formula/delete/{id<\d+>}', name: "delete-formula")]
    public function deleteFormula(Menu $menus, ManagerRegistry $doctrine): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $em = $doctrine->getManager();
            $em->remove($menus);
            $em->flush();
            return $this->redirectToRoute("formula");
        }
        return $this->redirectToRoute("home");
    }

    #[Route('/formula/edit/{id<\d+>}', name: "edit-formula")]
    public function updateFormula(Request $request, Menu $menus, ManagerRegistry $doctrine): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $menuForm = $this->createForm(MenuType::class, $menus);
            $menuForm->handleRequest($request);
            if ($menuForm->isSubmitted() && $menuForm->isValid()) {
                $em = $doctrine->getManager();
                $em->persist($menus);
                $em->flush();
                return $this->redirectToRoute("formula");
            }

            return $this->render('Formulas/FormFormula.html.twig', [
                "menus" => $menuForm->createView()
            ]);
        }
        return $this->redirectToRoute("home");
    }

}