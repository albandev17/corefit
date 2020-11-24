<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Program;
use App\Form\SearchType as FormSearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgramController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/programmes", name="programs")
     */
    public function index(Request $request): Response
    {
        $search = new Search();
        $form = $this->createForm(FormSearchType::class, $search);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $programs = $this->entityManager->getRepository(Program::class)->findWithSearch($search); 
        } else {
            $programs = $this->entityManager->getRepository(Program::class)->findAll();
        }

        return $this->render('program/index.html.twig', [
            'programs' => $programs,
            'form'     => $form->createView()
        ]);
    }

        /**
     * @Route("/programmes/{slug}", name="program")
     */
    public function show($slug)
    {
        $program = $this->entityManager->getRepository(Program::class)->findOneBySlug($slug);

        if (!$program){
            return $this->redirectToRoute('programs');
        }

        return $this->render('program/show.html.twig', [
            'program' => $program
        ]);
    }
}
