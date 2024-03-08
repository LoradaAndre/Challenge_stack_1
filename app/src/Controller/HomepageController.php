<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cours;
use App\Entity\Classe;
use App\Entity\Formateur;
use App\Entity\Etudiant;
use App\Repository\CoursRepository;
use App\Repository\ClasseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;



class HomepageController extends AbstractController
{

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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
public function dashboardF(Security $security, CoursRepository $coursRepository, EntityManagerInterface $entityManager): Response
{
    $user = $security->getUser();
    $idUtilisateur = $user->getId();
    $statut = $user->getStatut(); // Assure-toi que ton entité User a une méthode getStatut()

    if ($statut == "formateur") {
        $cours = $coursRepository->findByFormateurId($idUtilisateur);
        $countCours = $coursRepository->countByFormateur($idUtilisateur);
    } elseif ($statut == "etudiant") {
        $etudiant = $entityManager->getRepository(Etudiant::class)->findOneBy(['id_utilisateur' => $idUtilisateur]);
        if ($etudiant) {
            // Supposons que tu as une méthode pour trouver les cours par l'ID de la classe de l'étudiant
            // Cette méthode doit être implémentée dans le repository correspondant
            $cours = $coursRepository->findByClasseId($etudiant->getIdClasse()->getId());
            $countCours = count($cours); // Simplement compter le nombre de cours récupérés
        } else {
            // Gérer le cas où l'étudiant n'est pas trouvé
            $cours = [];
            $countCours = 0;
        }
    } else {
        // Gérer les autres statuts ou l'absence de statut
        $cours = [];
        $countCours = 0;
    }

    return $this->render('dashboards/formateurDashboard.html.twig', [
        'controller_name' => 'FormateurDashboarController',
        'cours_count' => $countCours,
        'cours' => $cours,
    ]);
}


    // #[Route('/organismes', name: 'app_organismes')]
    // public function organismes(): Response
    // {
    //     return $this->render('dashboards/OrganismesFormateur.html.twig', [
    //         'controller_name' => 'OrganismesController',
    //     ]);
    // }

    #[Route('/eleves', name: 'app_eleves')]

    public function eleves(ClasseRepository $classeRepository, Security $security): Response
    {
        

        
        $userStatut = 'etudiant';

        

        $queryBuilder = $this->entityManager->createQueryBuilder();

        $results = $queryBuilder
        ->select('u', 'e', 'c')
        ->from('App\Entity\Etudiant', 'e')
        ->leftJoin('e.id_utilisateur', 'u') 
        ->leftJoin('e.id_classe', 'c')   
        ->where('u.statut = :userStatut')
        ->setParameter('userStatut', $userStatut)
        ->getQuery()
        ->getResult();

    // dd($results);

        return $this->render('dashboards/ElevesListe.html.twig', [
            'etudiants' => $results,
        ]);
    
    
        
    }

    #[Route('/addEleves', name: 'app_addEleves')]
    public function addeleves(): Response
    {
        return $this->render('dashboards/AddEtudiant.html.twig', [
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
