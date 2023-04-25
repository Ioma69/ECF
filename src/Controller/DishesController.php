<?php

namespace App\Controller;

use App\Entity\Dishes;
use App\Form\DishesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DishesController extends AbstractController
{
    #[Route('/menu', name: 'menu')]
    public function menu(Request $request): Response
    {
        $dishes = new Dishes();
        $dishesForm = $this->createForm(DishesType::class, $dishes);
        dump($dishes);
        $dishesForm->handleRequest($request);
        if ($dishesForm->isSubmitted() && $dishesForm->isValid()) { 
            dump($dishes);
        }
        return $this->render('dishes/menu.html.twig', [
            "dishes" => $dishesForm->createView()
        ]);
    }
}
