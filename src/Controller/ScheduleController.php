<?php

namespace App\Controller;

use App\Entity\Schedule;
use App\Form\ScheduleType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ScheduleController extends AbstractController
{
    #[Route('/schedule', name: 'schedule')]
    public function index(ManagerRegistry $doctrine,\Twig\Environment $twig): Response
    {
        $repository = $doctrine->getRepository(Schedule::class);           
        $schedules = $repository->findAll(); 
        return $this->render('schedule/Schedule.html.twig',[                 
            $twig->addGlobal("schedules",$schedules)
        ]);
        
    }
    

    #[Route('/schedule/upload', name: 'addSchedules')]
    public function schedules(Request $request, ManagerRegistry $doctrine): Response
    {
        if ($this->isGranted('ROLE_ADMIN')){
        $schedules = new Schedule();
        $scheduleForm = $this->createForm(ScheduleType::class, $schedules);
        $scheduleForm->handleRequest($request);
        $scheduleRepository = $doctrine->getRepository(Schedule::class);
        $existingSchedules = $scheduleRepository->findAll();
        if ($existingSchedules && $scheduleForm->isSubmitted()) {
            $this->addFlash('error', 'Impossible d\'ajouter des horaires, ils existent déjà.');
        }
        if ($scheduleForm->isSubmitted() && $scheduleForm->isValid() && !$existingSchedules) { 
            $schedules->setAdminSchedule($this->getUser()); 
            $em = $doctrine->getManager();
            $em->persist($schedules);
            $em->flush();
            return $this->redirectToRoute("schedule");
        }
        return $this->render('schedule/FormSchedule.html.twig', [
            "schedules" => $scheduleForm->createView()
        ]);
    }
    return $this->redirectToRoute("formula");
    }

}
