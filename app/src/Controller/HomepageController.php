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

    #[Route('/dashboardE', name: 'app_dashboard-E')]
    public function dashboardE(): Response
    {
        return $this->render('dashboards/EtudientDashboard.html.twig', [
            'controller_name' => 'EtudientDashboardController',
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
        return $this->render('dashboards/AddElevesFormateur.html.twig', [
            'controller_addeleves' => 'AddElevesController',
        ]);
    }

    
}
