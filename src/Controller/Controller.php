<?php

namespace App\Controller;

use App\Entity\PicDishes;
use App\Entity\Schedule;
use App\Form\PicDishesType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class Controller extends AbstractController
{
    #[Route('/', name: "home")]
    public function index(ManagerRegistry $doctrine, \Twig\Environment $twig): Response
    {
        $repository = $doctrine->getRepository(PicDishes::class); // Récupération du repository de l'entité "PicDishes"
        $picdishes = $repository->findAll(); // SELECT * FROM 'picDishes';  // Stocke toutes les photos dans la variable $picdishes
        $repository = $doctrine->getRepository(Schedule::class);
        $schedules = $repository->findAll();
        return $this->render('PicDishes/index.html.twig', [
            // Envoie le tableau des photos au template Twig
            "picdishes" => $picdishes,
            $twig->addGlobal("schedules", $schedules),
        ]);
    }

    #[Route('/Picdishes/upload')]
    public function create(Request $request, ManagerRegistry $doctrine, SluggerInterface $slugger,): Response // Injection de l'objet ManagerRegistry + slugger interface
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $picdishes = new PicDishes();
            $form = $this->createForm(PicDishesType::class, $picdishes);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $image = $form->get('image')->getData();
                if ($image) {
                    $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension(); // le nom du fichier est rendu unique grace au uniqid
                    try {
                        $image->move(
                            $this->getParameter('uploads'),
                            // deplace l'image dans un dossier uploads
                            $newFilename
                        );
                    } catch (FileException) {
                        $this->addFlash('error', 'erreur dans le traitement de la photo, veuillez réessayer');
                    }
                    $picdishes->setImage($newFilename);
                }

                $picdishes->setAdmin($this->getUser()); //  recupere l'utilisateur connecté
                $em = $doctrine->getManager(); // Recuperation d'une instance d'entity manager
                $em->persist($picdishes); // Ajout de l'objet $picdishes à l'EM        
                $em->flush(); // Synchronisation de l'object ajouté à l'Em avec la BDD
                return $this->redirectToRoute("home");
            }


            return $this->render('PicDishes/PicDishes.html.twig', [
                "picdishes_form" => $form->createView()
            ]);
        }
        return $this->redirectToRoute("login");
    }


    #[Route('/Picdishes/edit/{id<\d+>}', name: "edit-picdishe")]
    public function update(Request $request, Picdishes $picdishes, ManagerRegistry $doctrine, SluggerInterface $slugger): Response // Injection de l'objet ManagerRegistry
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $form = $this->createForm(PicDishesType::class, $picdishes);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $image = $form->get('image')->getData();
                if ($image) {
                    $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                    $safeFilename = $slugger->slug($originalFilename);
                    $newFilename = $safeFilename . '-' . uniqid() . '.' . $image->guessExtension(); // le nom du fichier est rendu unique grace au uniqid
                    try {
                        $image->move(
                            $this->getParameter('uploads'),
                            // deplace l'image dans un dossier uploads
                            $newFilename
                        );
                    } catch (FileException $e) {
                        dump($e);
                    }
                    $picdishes->setImage($newFilename);
                }

                $em = $doctrine->getManager(); // Recuperation d'un instance d'entity manager
                $em->persist($picdishes); // Ajout de l'objet $picdishes à l'EM        
                $em->flush(); // Synchronisation de l'object ajouté à l'Em avec le BDD
                return $this->redirectToRoute("home");
            }

            return $this->render('PicDishes/PicDishes.html.twig', [
                "picdishes_form" => $form->createView()
            ]);

        }
        return $this->redirectToRoute("login");
    }


    #[Route('/Picdishes/delete/{id<\d+>}', name: "delete-picdishe")]
    public function delete(Picdishes $picdishes, ManagerRegistry $doctrine): Response // Injection de l'objet ManagerRegistry
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            $em = $doctrine->getManager();
            $em->remove($picdishes);
            $em->flush();
            return $this->redirectToRoute("home");
        }
        return $this->redirectToRoute("home");
    }


}