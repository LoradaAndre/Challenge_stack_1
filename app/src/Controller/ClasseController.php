<?php

namespace App\Controller;

use App\Entity\Organisme; 
use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use App\Repository\EtudiantRepository;
use App\Repository\OrganismeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Attribute\Route;
//use Symfony\Component\Security\Core\Security;

#[Route('/classe')]
class ClasseController extends AbstractController
{
    #[Route('/', name: 'app_classe_index', methods: ['GET'])]
    public function index(ClasseRepository $classeRepository, EntityManagerInterface $entityManager, EtudiantRepository $etudiantRepository): Response
    {
        

        $classes = $classeRepository->findAll();
        $classesWithStudentsCount = [];
    
        foreach ($classes as $classe) {
            $organismeId = $classe->getIdOrganisme();

        // Récupérer l'organisme à partir de son ID
        $organisme = $entityManager->getRepository(Organisme::class)->find($organismeId);
        
            $studentsCount = $etudiantRepository->countStudentsByClass($classe->getId());

            $classesWithStudentsCount[] = [
                'classe' => $classe,
                'studentsCount' => $studentsCount,
                'organisme' => $organisme->getNom(),
            ];
        }
    
        // Pass the classes with students count to the Twig template
        return $this->render('classe/index.html.twig', [
            'classesWithStudentsCount' => $classesWithStudentsCount,
        ]);
        
    }

    
    
    #[Route('/new', name: 'app_classe_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $classe = new Classe();
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($classe);
            $entityManager->flush();

            return $this->redirectToRoute('app_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('classe/new.html.twig', [
            'classe' => $classe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_classe_show', methods: ['GET'])]
    public function show(Classe $classe): Response
    {
        return $this->render('classe/show.html.twig', [
            'classe' => $classe,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_classe_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Classe $classe, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ClasseType::class, $classe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_classe_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('classe/edit.html.twig', [
            'classe' => $classe,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_classe_delete', methods: ['POST'])]
    public function delete(Request $request, Classe $classe, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classe->getId(), $request->request->get('_token'))) {
            $entityManager->remove($classe);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_classe_index', [], Response::HTTP_SEE_OTHER);
    }
}
