<?php

namespace App\Controller;

use App\Entity\TICKET;
use App\Form\TICKETType;
use App\Repository\TICKETRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/t/i/c/k/e/t')]
class TICKETController extends AbstractController
{
    #[Route('/', name: 'app_t_i_c_k_e_t_index', methods: ['GET'])]
    public function index(TICKETRepository $tICKETRepository): Response
    {
        return $this->render('ticket/index.html.twig', [
            't_i_c_k_e_ts' => $tICKETRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_t_i_c_k_e_t_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tICKET = new TICKET();
        $form = $this->createForm(TICKETType::class, $tICKET);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tICKET);
            $entityManager->flush();

            return $this->redirectToRoute('app_t_i_c_k_e_t_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ticket/new.html.twig', [
            't_i_c_k_e_t' => $tICKET,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_t_i_c_k_e_t_show', methods: ['GET'])]
    public function show(TICKET $tICKET): Response
    {
        return $this->render('ticket/show.html.twig', [
            't_i_c_k_e_t' => $tICKET,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_t_i_c_k_e_t_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TICKET $tICKET, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TICKETType::class, $tICKET);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_t_i_c_k_e_t_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('ticket/edit.html.twig', [
            't_i_c_k_e_t' => $tICKET,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_t_i_c_k_e_t_delete', methods: ['POST'])]
    public function delete(Request $request, TICKET $tICKET, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tICKET->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tICKET);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_t_i_c_k_e_t_index', [], Response::HTTP_SEE_OTHER);
    }
}
