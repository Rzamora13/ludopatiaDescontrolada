<?php

namespace App\Controller;

use App\Entity\Apuesta;
use App\Entity\Sorteo;
use App\Entity\Ticket;
use App\Form\SorteoType;
use App\Repository\ApuestaRepository;
use App\Repository\SorteoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sorteo')]
class SorteoController extends AbstractController
{
    #[Route('/', name: 'app_sorteo_index', methods: ['GET'])]
    public function index(SorteoRepository $sorteoRepository): Response
    {
        return $this->render('sorteo/index.html.twig', [
            'sorteos' => $sorteoRepository->findAll(),
        ]);

    }

    #[Route('/comprar-ticket/{id}', name: 'app_sorteo_comprar-ticket', methods: ['GET'])]
    public function ticketsAvailable(ApuestaRepository $apuestaRepository, Sorteo $sorteo): Response
    {

        $ticketsDisponibles = $apuestaRepository->getAvailableTickets($sorteo);

        return $this->render('sorteo/buyTicket.html.twig', [
            'ticketsDisponibles' => $ticketsDisponibles,
        ]);

    }

    #[Route('/new', name: 'app_sorteo_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $sorteo = new Sorteo();
        $form = $this->createForm(SorteoType::class, $sorteo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $numeroTickets = $sorteo->getTicketsTotales();

            // dd($numeroTickets);

            for ($i=0; $i < $numeroTickets; $i++){
                $apuesta = new Apuesta();
                $ticket = new Ticket();
                
                $ticket->setNumero($i);

                $apuesta -> setSorteo($sorteo);
                $apuesta -> setTicket($ticket);


                $entityManager->persist($apuesta);
                $entityManager->persist($ticket);
            }

            $entityManager->persist($sorteo);
            $entityManager->flush();

            

            return $this->redirectToRoute('app_sorteo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sorteo/new.html.twig', [
            'sorteo' => $sorteo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sorteo_show', methods: ['GET'])]
    public function show(Sorteo $sorteo): Response
    {
        return $this->render('sorteo/show.html.twig', [
            'sorteo' => $sorteo,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sorteo_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Sorteo $sorteo, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SorteoType::class, $sorteo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_sorteo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('sorteo/edit.html.twig', [
            'sorteo' => $sorteo,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sorteo_delete', methods: ['POST'])]
    public function delete(Request $request, Sorteo $sorteo, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sorteo->getId(), $request->request->get('_token'))) {
            $entityManager->remove($sorteo);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_sorteo_index', [], Response::HTTP_SEE_OTHER);
    }
}
