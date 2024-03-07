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
    public function organisations(): Response
    {
        return $this->render('dashboards/OrganismesFormateur.html.twig', [
            'controller_name' => 'OrganismesController',
        ]);
    }

    #[Route('/AddOrganismes', name: 'app_Add-Organismes')]
    public function AddOrganismes(): Response
    {
        return $this->render('dashboards/AddOrganismes.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    #[Route('/AddEtudiant', name: 'app_AddEtudiant')]
    public function AddEtudiant(): Response
    {
        return $this->render('dashboards/AddEtudiant.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

    #[Route('/AddCours', name: 'app_AddCours')]
    public function AddCours(): Response
    {
        return $this->render('dashboards/AddCours.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }

}
