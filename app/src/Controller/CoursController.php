<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Etudiant;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use App\Repository\ClasseRepository;
use App\Entity\Formateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security;

#[Route('/cours')]
class CoursController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'app_cours', methods: ['GET'])]
    public function index(CoursRepository $coursRepository, Security $security, EntityManagerInterface $entityManager): Response
{
    $user = $security->getUser();
    $userId = $user->getID();
    $queryBuilder = $entityManager->createQueryBuilder();

    if ($user->getStatut() == "formateur") {
        $results = $queryBuilder
            ->select('c')
            ->from('App\Entity\Cours', 'c')
            ->join('c.id_formateur', 'f')
            ->where('f.id_utilisateur = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
    } elseif ($user->getStatut() == "etudiant") {
        $etudiant = $entityManager->getRepository(Etudiant::class)->findOneBy(['id_utilisateur' => $userId]);
        if ($etudiant) {
            $classeId = $etudiant->getIdClasse()->getId();
            $results = $queryBuilder
                ->select('c')
                ->from('App\Entity\Cours', 'c')
                ->join('c.id_classe', 'cl')
                ->where(':classeId MEMBER OF c.id_classe')
                ->setParameter('classeId', $classeId)
                ->getQuery()
                ->getResult();
        } else {
            dd($results);
            // Gérer le cas où l'étudiant n'est inscrit à aucune classe
            $results = [];
        }
    } else {
        // Gérer les autres statuts ou l'absence de statut
        $results = [];
    }

    return $this->render('dashboards/CoursFormateur.html.twig', [
        'cours' => $results,
    ]);
}




    
    
  

    #[Route('/add', name: 'app_cours_add')]
public function AddCours(Request $request, EntityManagerInterface $entityManager, Security $security, ClasseRepository $classeRepository): Response
{
    $cour = new Cours();
    $form = $this->createForm(CoursType::class, $cour);
    $form->handleRequest($request);
    
    $classes = $classeRepository->findAll();
     
    if ($form->isSubmitted() && $form->isValid()) {
        $user = $security->getUser();
        $formateur = $entityManager->getRepository(Formateur::class)->findOneBy(['id_utilisateur' => $user->getId()]);
        $cour->setIdFormateur($formateur); 
        $idsClasses = $form->get('id_classe')->getData(); // Si tu utilises le form builder, tu n'as pas besoin de prendre depuis la requête.
        foreach ($idsClasses as $classe) {
            $cour->addIdClasse($classe);
        }
    
        $entityManager->persist($cour);
        $entityManager->flush();

        $this->addFlash('success', 'Le cours a été ajouté avec succès.');
        return $this->redirectToRoute('app_cours'); // Remplacer 'app_cours' par la route où tu veux rediriger après l'ajout
    } else if ($form->isSubmitted() && !$form->isValid()) {
        dd($form);
         // Affiche les erreurs de formulaire
         foreach ($form->getErrors(true) as $error) {
            $this->addFlash('error', $error->getMessage());
        }
    }
    
    return $this->render('dashboards/AddCours.html.twig', [
        'form' => $form->createView(),
        'classes' => $classes,
    ]);
}

    

    #[Route('/new', name: 'app_cours_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $user = $security->getUser();
            $idFormateur = $user->getId();
            
            $formateur = $entityManager->getRepository(Formateur::class)->findOneBy(['id_utilisateur' => $idFormateur]);

            $cour->setIdFormateur($formateur);
      
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cours/new.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cours_show', methods: ['GET'])]
    public function show(Cours $cour): Response
    {
        return $this->render('cours/show.html.twig', [
            'cour' => $cour,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_cours_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Cours $cour, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cours/edit.html.twig', [
            'cour' => $cour,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_cours_delete', methods: ['POST'])]
    public function delete(Request $request, Cours $cour, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cour->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cour);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_cours', [], Response::HTTP_SEE_OTHER);
    }
}
