<?php

namespace App\Controller;

use App\Entity\SORTEO;
use App\Form\SORTEOType;
use App\Repository\SORTEORepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/s/o/r/t/e/o')]
class SORTEOController extends AbstractController
{
    #[Route('/', name: 'app_s_o_r_t_e_o_index', methods: ['GET'])]
    public function index(SORTEORepository $sORTEORepository): Response
    {
        return $this->render('sorteo/index.html.twig', [
            's_o_r_t_e_os' => $sORTEORepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_s_o_r_t_e_o_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sORTEO = new SORTEO();
        $form = $this->createForm(SORTEOType::class, $sORTEO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($sORTEO);
            $entityManager->flush();

            return $this->redirectToRoute('app_s_o_r_t_e_o_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sorteo/new.html.twig', [
            's_o_r_t_e_o' => $sORTEO,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_s_o_r_t_e_o_show', methods: ['GET'])]
    public function show(SORTEO $sORTEO): Response
    {
        return $this->render('sorteo/show.html.twig', [
            's_o_r_t_e_o' => $sORTEO,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_s_o_r_t_e_o_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SORTEO $sORTEO, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SORTEOType::class, $sORTEO);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_s_o_r_t_e_o_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sorteo/edit.html.twig', [
            's_o_r_t_e_o' => $sORTEO,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_s_o_r_t_e_o_delete', methods: ['POST'])]
    public function delete(Request $request, SORTEO $sORTEO, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sORTEO->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sORTEO);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_s_o_r_t_e_o_index', [], Response::HTTP_SEE_OTHER);
    }
}
