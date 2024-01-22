<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(SerializerInterface $serializer): Response
    {
        return $this->redirectToRoute("app_login");
        // return $this->render('main/index.html.twig', [
        //     'controller_name' => 'MainController',
        // ]);
    }
}
