<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function homepage(): Response
    {       
         return new Response('<strong>Starshop</strong>: your monopoly-busting option for Starship parts!');
    }
}
