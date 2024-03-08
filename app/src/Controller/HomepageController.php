<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

     #[Route('/dashboardF', name: 'app_dashboard-F')]
    public function dashboardF(): Response
    {
        return $this->render('dashboards/formateurDashboard.html.twig', [
            'controller_name' => 'FormateurDashboarController',
        ]);
    }

    #[Route('/organismes', name: 'app_organismes')]
    public function organismes(): Response
    {
        return $this->render('dashboards/OrganismesFormateur.html.twig', [
            'controller_name' => 'OrganismesController',
        ]);
    }

    #[Route('/classes', name: 'app_classes')]
    public function classes(): Response
    {
        return $this->render('dashboards/ClassesFormateur.html.twig', [
            'controller_name' => 'ClassesController',
        ]);
    }

    #[Route('/eleves', name: 'app_eleves')]
    public function eleves(): Response
    {
        return $this->render('dashboards/ElevesFormateur.html.twig', [
            'controller_eleves' => 'ElevesController',
        ]);
    }

    #[Route('/addEleves', name: 'app_addEleves')]
    public function addeleves(): Response
    {
        return $this->render('dashboards/AddEtudiant.html.twig', [
            'controller_addeleves' => 'AddElevesController',
        ]);
    }

    #[Route('/coursf', name: 'app_cours')]
    public function coursformateur(): Response
    {
        return $this->render('dashboards/CoursFormateur.html.twig', [
            'controller_cours' => 'CoursController',
        ]);
    }

    #[Route('/AddExamen', name: 'app_AddExamen')]
    public function AddExamen(): Response
    {
        return $this->render('dashboards/AddExamen.html.twig', [
            'controller_exam' => 'HomepageController',
        ]);
    }

    #[Route('/AddCours', name: 'app_AddCours')]
    public function AddCours(): Response
    {
        // $questionCount = $request->query->get('question_count', 1); // Default to 1 question

        
        return $this->render('dashboards/AddCours.html.twig', [
            'controller_AddCours' => 'HomepageController',
            // 'question_count' => $questionCount,
        ]);
    }

    
}
