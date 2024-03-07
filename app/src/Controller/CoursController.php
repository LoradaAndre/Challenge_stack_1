<?php

namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Formateur;
use App\Form\CoursType;
use App\Repository\CoursRepository;
use Symfony\Component\Security\Core\Security;
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
    #[Route('/', name: 'app_cours_index', methods: ['GET'])]
    public function index(CoursRepository $coursRepository, Security $security): Response
    {
        $user = $security->getUser();

        $userId = $user->getID();
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $results = $queryBuilder
            ->select('c')
            ->from('App\Entity\Cours', 'c')
            ->join('c.id_formateur', 'f')
            ->join('f.id_utilisateur', 'u')
            ->where('u.id = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();

            return $this->render('cours/index.html.twig', ['cours' => $results]);

    }

    
    #[Route('/liste', name: 'app_cours')]
    public function coursFormateur(CoursRepository $coursRepository, Security $security): Response
    {
        $user = $security->getUser();

        $userId = $user->getID();
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $results = $queryBuilder
            ->select('c')
            ->from('App\Entity\Cours', 'c')
            ->join('c.id_formateur', 'f')
            ->join('f.id_utilisateur', 'u')
            ->where('u.id = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();

            return $this->render('dashboards/CoursFormateur.html.twig', [
                'cours' => $results,
            ]);

    }

    #[Route('/add', name: 'app_cours_add')]
    public function AddCours(Request $request, EntityManagerInterface $entityManager, Security $security): Response
    {
        $cour = new Cours();
        $form = $this->createForm(CoursType::class, $cour);
        $form->handleRequest($request);
     
        if ($form->isSubmitted()) {

            $user = $security->getUser();
            $idFormateur = $user->getId();
            
            $formateur = $entityManager->getRepository(Formateur::class)->findOneBy(['id_utilisateur' => $idFormateur]);

            $cour->setIdFormateur($formateur);
     
            $entityManager->persist($cour);
            $entityManager->flush();

            return $this->redirectToRoute('app_cours', [], Response::HTTP_SEE_OTHER);
        }

        
        return $this->render('dashboards/AddCours.html.twig', [
            'form' => $form->createView()
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

        return $this->redirectToRoute('app_cours_index', [], Response::HTTP_SEE_OTHER);
    }
}
