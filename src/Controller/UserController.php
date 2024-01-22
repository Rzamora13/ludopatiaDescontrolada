<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $saldoActual = $user->getSaldo();
            $saldoForm = $form['saldo']->getData();
            $saldoFinal = $saldoActual + $saldoForm;
            
            $user->setSaldo($saldoFinal);

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_sorteo_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/admin/maxSaldo', name: 'app_user_addMaxSaldo', methods: ['GET', 'POST'])]
    public function maxSaldo(Request $request, User $user, UserRepository $userRepository, EntityManagerInterface $entityManager): Response
    {
        $maxSaldoUsers = $userRepository->getMaxSaldoUser();
    

        return $this->render('user/adminMaxSaldo.html.twig', [
            'maxSaldoUsers' => $maxSaldoUsers,
            'user' => $user,
        ]);
    }
}
