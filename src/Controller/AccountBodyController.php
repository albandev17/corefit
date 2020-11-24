<?php

namespace App\Controller;

use App\Entity\Body;
use App\Form\RegisterBodyType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountBodyController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/account/informations-personelles", name="account_body")
     */
    public function index(): Response
    {
        return $this->render('account_body/index.html.twig');
    }

    /**
     * @Route("/account/ajouter-informations-personelles", name="account_body__add")
     */
    public function add(Request $request): Response
    {
        $body = new Body();

        $form = $this->createForm(RegisterBodyType::class, $body);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $body->setUser($this->getUser());
            $this->entityManager->persist($body);
            $this->entityManager->flush();
        }

        return $this->render('account_body/index_add.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/account/modifier-informations-personelles/{id}", name="account_body__edit")
     */
    public function edit(Request $request, $id): Response
    {
        $body = $this->entityManager->getRepository(Body::class)->findOneById($id);

        if (!$body|| $body->getUser() != $this->getUser()){
            return $this->redirectToRoute('account_body');
        }

        $form = $this->createForm(RegisterBodyType::class, $body);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->entityManager->flush();
            return $this->redirectToRoute('account_body');
        }

        return $this->render('account_body/index_add.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/compte/supprimer-informations-personelles/{id}", name="account_body__delete")
     */
    public function delete($id)
    {
        $body = $this->entityManager->getRepository(Body::class)->findOneById($id);

        if ($body && $body->getUser() == $this->getUser()){
            $this->entityManager->remove($body);
            $this->entityManager->flush();
        }
        
        return $this->redirectToRoute('account_body');
    }
}
