<?php

namespace App\Controller;

use App\Entity\Technical;
use App\Event\TechnicalCreatedEvent;
use App\Form\TechnicalType;
use App\Repository\TechnicalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TechController extends AbstractController
{
    public function __construct(
        private readonly TechnicalRepository $technicalRepository,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    #[Route('/tech/create', name: 'app_tech_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $technical = new Technical();
        $form = $this->createForm(TechnicalType::class, $technical);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($technical);
            $entityManager->flush();
            $this->eventDispatcher->dispatch(new TechnicalCreatedEvent($technical));
            $this->addFlash('success', 'tech.flash.created');

            return $this->redirectToRoute('app_tech');
        }

        return $this->render('tech/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/tech/{id}/edit', name: 'app_tech_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Request $request, Technical $technical, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TechnicalType::class, $technical, [
            'submit_label' => 'tech.form.update',
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'tech.flash.updated');

            return $this->redirectToRoute('app_tech');
        }

        return $this->render('tech/edit.html.twig', [
            'form' => $form,
            'technical' => $technical,
        ]);
    }

    #[Route('/tech/{id}/delete', name: 'app_tech_delete', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function delete(Request $request, Technical $technical, EntityManagerInterface $entityManager): Response
    {
        $submittedToken = (string) $request->request->get('_token');
        if (!$this->isCsrfTokenValid('delete_technical_'.$technical->getId(), $submittedToken)) {
            $this->addFlash('error', 'tech.flash.delete_csrf');

            return $this->redirectToRoute('app_tech');
        }

        $entityManager->remove($technical);
        $entityManager->flush();
        $this->addFlash('success', 'tech.flash.deleted');

        return $this->redirectToRoute('app_tech');
    }

    #[Route('/tech', name: 'app_tech')]
    public function index(): Response
    {
        $technicals = $this->technicalRepository->findBy([], ['title' => 'ASC']);

        return $this->render('tech/index.html.twig', [
            'technicals' => $technicals,
        ]);
    }
}
