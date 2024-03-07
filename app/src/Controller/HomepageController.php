<?php

namespace App\Controller;
use Symfony\Component\Security\Core\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cours;
use App\Entity\Formateur;
use App\Repository\CoursRepository;
use Doctrine\ORM\EntityManagerInterface;


class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function index(Security $security): Response
    {
        $user = $security->getUser();
        if($user){
            return $this->redirectToRoute('app_dashboard');
        }
        else{
            return $this->redirectToRoute('app_login');
        }
        
        
    }

     #[Route('/dashboardF', name: 'app_dashboard')]
    public function dashboardF(Security $security, CoursRepository $coursRepository, EntityManagerInterface $entityManager ): Response
    {
        $user = $security->getUser();
        $idFormateur = $user->getId();

        $cours = $coursRepository->findByFormateurId($idFormateur);
        
        $formateur = $entityManager->getRepository(Formateur::class)->findOneBy(['id_utilisateur' => $idFormateur]);

        $countCoursWithFormateur = $coursRepository->countByFormateur($idFormateur);

        return $this->render('dashboards/formateurDashboard.html.twig', [
            'controller_name' => 'FormateurDashboarController',
            'cours_count' => $countCoursWithFormateur,
            'cours' => $cours, //
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

    #[Route('/AddExamen', name: 'app_AddExamen')]
    public function AddExamen(): Response
    {
        return $this->render('dashboards/AddExamen.html.twig', [
            'controller_exam' => 'HomepageController',
        ]);
    }
    
}
