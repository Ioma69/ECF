<?php

namespace App\Controller;

use App\Entity\PicDishes;
use App\Form\PicDishesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class Controller extends AbstractController
{
    #[Route('/')]
    public function index(): Response
    {
        return $this->render('PicDishes/index.html.twig');
    }

    #[Route('/Picdishes/upload')]
    public function upload(): Response
    {
        $picdishes = new PicDishes();
        $form = $this->createForm(PicDishesType::class, $picdishes);
        return $this->render('PicDishes/PicDishes.html.twig', [
            "picdishes_form" => $form->createView()
        ]);
        
    }
}
